<?php

namespace App\Http\Controllers;

use App\Category;
use App\Province;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function edit()
    {
        $user = auth()->user();

        $user->load('categories');

        $user->append('category_ids');

        $cities = Province::with(['cities'])->get();

        $categories = Category::parents()->with(['children'])->get();

        return view('profile.form', [
            'user' => $user,
            'cities' => $cities,
            'categories' => $categories,
        ]);
    }

    public function update(Request $request)
    {
        $user = auth()->user();

        $rules = [
            'name' => 'required',
            'email' => 'required|email',
            'contact' => 'required',
            'contact_whatsapp' => 'required',
            'city_id' => 'min:1',
            'categories' => 'required',
        ];

        if ($user->type == User::TYPE_PARTNER)
        {
            $partnerOnlyRules = [
                'address' => 'required',
                'district' => 'required',
                'village' => 'required',
            ];

            $rules = array_merge($rules, $partnerOnlyRules);
        }

        $request->validate($rules);

        $this->save($user, $request);

        return redirect()->route('profile.edit')
            ->with('success', "Profil telah disimpan!");
    }

    public function updateServices(Request $request)
    {
        $user = auth()->user();
        $user->load('categories');

        foreach($user->categories as $category)
        {
            foreach($request->input('category_prices') as $id => $price)
            {
                $user->categories()->sync([
                    $id => [
                        'price' => $price,
                        'description' => $request->input('category_description')[$id],
                    ],
                ]);
            }
        }

        return redirect()->route('profile.edit')
            ->with('success', "Info Layanan telah disimpan!");
    }

    private function save(User $user, Request $request)
    {
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        if ($request->filled('password'))
        {
            $user->password = Hash::make($request->input('password'));
        }
        $user->city_id = $request->input('city_id');
        if ($user->type == User::TYPE_PARTNER)
        {

            $user->contact = $request->input('contact');
            $user->contact_whatsapp = $request->input('contact_whatsapp');
            $user->contact_telegram = $request->input('contact_telegram');
            $user->description = $request->input('description');
            $user->address = $request->input('address');
            $user->district = $request->input('district');
            $user->village = $request->input('village');

        }

        $user->save();

        if ($user->type != User::TYPE_PARTNER)
        {
            $this->storeImage($user, $request);
        }

        // sync categories
        if ($user->type == User::TYPE_PARTNER)
        {
            $user->categories()->sync($this->syncData($request));
        }

        return $user;
    }

    private function storeImage(User $user, Request $request)
    {

        $imageKeys = ['image', 'id_card_image'];
        \Log::debug('Image keys',['keys' => $imageKeys]);
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

    private function syncData(Request $request)
    {
        $data = [];

        if ($request->input('categories'))
        {
            foreach($request->input('categories') as $cat)
            {
                $data[$cat] = [
                    'price' => 0,
                    'description' => '',
                ];
            }
        }

        return $data;
    }
}
