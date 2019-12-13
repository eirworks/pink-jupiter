<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\City;
use App\Http\Controllers\Controller;
use App\Http\Middleware\AuthIsAdmin;
use App\Province;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class PartnerController extends Controller
{
    public function __construct()
    {
        $this->middleware(AuthIsAdmin::class);
    }

    public function index(Request $request)
    {
        $users = User::orderBy('id', 'desc')
            ->when(!$request->has('pending'), function($query) use($request) {
                $query->partner();
            }, function($query) use($request) {
                $query->pending();
            })
            ->with(['city:id,name,province_id', 'city.province:id,name'])
            ->paginate();

        return view('admin.partners.index', [
            'users' => $users,
            'pending' => $request->has('pending'),
        ]);
    }

    public function create(Request $request)
    {
        $user = new User();
        $cities = Province::with(['cities'])->get();

        return view('admin.partners.form', [
            'user' => $user,
            'cities' => $cities,
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'contact' => 'required',
            'password' => 'required',
            'city_id' => 'min:1',
        ]);

        $user = new User();
        $this->save($user, $request);

        return redirect()->route('admin.partners.index')
            ->with('success', 'Mitra telah disimpan');
    }

    public function edit(User $user)
    {
        $cities = Province::with(['cities'])->get();

        $categories = Category::parents()->with(['children'])->get();

        return view('admin.partners.form', [
            'user' => $user,
            'cities' => $cities,
            'categories' => $categories,
        ]);
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'contact' => 'required',
            'city_id' => 'min:1',
        ]);

        $this->save($user, $request);

        return redirect()->route('admin.partners.edit', [$user])
            ->with('success', 'Mitra telah disimpan');
    }

    public function activate(Request $request, User $user)
    {
        $user->activated = true;
        $user->save();

        return redirect()->route('admin.partners.index')
            ->with('success', 'Mitra telah diaktifkan');
    }

    private function save($user, Request $request)
    {
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->city_id = $request->input('city_id');
        $user->contact = $request->input('contact');
        $user->contact_whatsapp = $request->input('contact_whatsapp');
        $user->contact_telegram = $request->input('contact_telegram');
        $user->description = $request->input('description');
        $user->address = $request->input('address');
        if (!$user->id)
        {
            if ($request->filled('password'))
            {
                $user->password = Hash::make($request->input('password'));
            }
            $user->activated = true;
            $user->verified = false;
            $user->type = User::TYPE_PARTNER;
            $user->balance = 0;
            $user->data = [];
        }
        else {
            $user->password = Hash::make($request->input('password'));
        }

        $user->save();

        $this->saveImage($user, $request);

        // sync categories
        if ($user->type == User::TYPE_PARTNER)
        {
            $user->categories()->sync($this->syncData($request));
        }

        return $user;
    }

    public function saveImage(User $user, Request $request)
    {
        $imageKeys = ['image', 'id_card_image'];
        $addImage = false;

        foreach($imageKeys as $imageKey)
        {
            if ($request->hasFile($imageKey))
            {
                \Log::debug('Has file',['image key' => $imageKey]);
                $file = $request->file($imageKey);

                if ($file->isValid())
                {
                    $imageFilename = $file->store('services/'.($imageKey == 'id_card_image' ? 'id_card/' : '').$user->id, [
                        'disk' => 'public',
                    ]);

                    $user->$imageKey = $imageFilename;
                    \Log::debug('Image saved',['name' => $imageFilename]);
                    $addImage = true;

                    $path = config('filesystems.disks.public.root').'/'.$user->$imageKey;
                    \Log::debug('Resize Image',['source' => $path]);
                    if ($imageKey == 'id_card_image')
                    {
                        \Log::debug('Resizing id card',[]);
                        \Image::make( $path )->resize(400, null, function($constraint) {
                            $constraint->aspectRatio();
                        })
                            ->save($path);
                    }
                    else {
                        \Image::make( $path )->fit(400, 400)
                            ->save($path);
                    }
                }
            }
        }

        if ($addImage) // save user if there are any image uploads
        {
            $user->save();
        }

        return $user;
    }

    public function destroy(User $user)
    {
        $user->delete();

        return redirect()->route('admin.partners.index')
            ->with('success', 'Akun mitra telah dihapus');
    }

}
