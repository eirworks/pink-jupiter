<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Middleware\AuthIsAdmin;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware(AuthIsAdmin::class);
    }

    public function index(Request $request)
    {
        $users = User::orderBy('id', 'desc')
            ->where('type', User::TYPE_ADMIN)
            ->paginate();

        return view('admin.admins.index', [
            'users' => $users,
        ]);
    }

    public function create(Request $request)
    {
        $user = new User();

        return view('admin.admins.form', [
            'user' => $user,
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

        return redirect()->route('admin.admin.index')
            ->with('success', 'Admin telah disimpan');
    }

    public function edit(User $user)
    {
        return view('admin.admins.form', [
            'user' => $user,
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

        return redirect()->route('admin.admin.edit', [$user])
            ->with('success', 'Admin telah disimpan');
    }

    private function save($user, Request $request)
    {
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        if ($user->id)
        {
            if ($request->filled('password'))
            {
                $user->password = Hash::make($request->input('password'));
            }
        }
        else {
            $user->password = Hash::make($request->input('password'));
        }
        $user->city_id = 0;
        $user->contact = "";
        $user->contact_whatsapp = "";
        $user->contact_telegram = "";
        $user->description = "";
        $user->address = "";

        $user->activated = true;
        $user->verified = true;
        $user->type = User::TYPE_ADMIN;
        $user->balance = 0;
        $user->data = [];

        $user->image = "";
        $user->id_card_image = "";

        $user->save();

        return $user;
    }

    public function destroy(User $user)
    {
        $user->delete();

        return redirect()->route('admin.admin.index')
            ->with('success', 'Akun admin telah dihapus');
    }
}
