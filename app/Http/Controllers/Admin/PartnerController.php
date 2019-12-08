<?php

namespace App\Http\Controllers\Admin;

use App\City;
use App\Http\Controllers\Controller;
use App\Province;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class PartnerController extends Controller
{
    public function index(Request $request)
    {
        $users = User::orderBy('id', 'desc')
            ->when(!$request->has('pending'), function($query) use($request) {
                $query->partner();
            }, function($query) use($request) {
                $query->pending();
            })
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

        return view('admin.partners.form', [
            'user' => $user,
            'cities' => $cities,
        ]);
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'contact' => 'required',
            'password' => 'required',
            'city_id' => 'min:1',
        ]);

        $this->save($user, $request);

        return redirect()->route('admin.partners.index')
            ->with('success', 'Mitra telah disimpan');
    }

    public function activate(Request $request, User $user)
    {
        $user->activated = true;
        $user->save();

        return redirect()->route('admin.partners.index')
            ->with('success', 'Mitra telah diaktifkan');
    }

    private function save($user, $request)
    {
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->password = Hash::make($request->input('password'));
        $user->city_id = $request->input('city_id');
        $user->contact = $request->input('contact');
        $user->activated = true;
        $user->type = User::TYPE_PARTNER;
        $user->balance = 0;
        $user->data = [];
        $user->save();

        return $user;
    }

    public function destroy(User $user)
    {
        $user->delete();

        return redirect()->route('admin.partners.index')
            ->with('success', 'Akun mitra telah dihapus');
    }

}
