<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::get();
        return view('admin.user.user', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.user.tambahuser', ['user' => new User()]);
    }


    public function store(Request $request)
    {

        $request->validate([
            'name' => 'required|min:3|max:30',
            'username' => 'required|alpha_dash|unique:users|min:5',
            'role' => 'required',

        ]);

        if ($request->input('password')) {
            $password = Hash::make($request->password);
        } else {
            $password = Hash::make('12345678');
        }

        User::create([
            'name' => $request->name,
            'username' => $request->username,
            'password' => $password,
            'role' => $request->role

        ]);

        alert()->success('Sukses', 'Data berhasil disimpan.');
        return redirect('user');
    }

    public function show($id)
    {
        //
    }


    public function edit(User $user)
    {
        return view('admin.user.edituser', compact('user'));
    }


    public function update(User $user, Request $request)
    {
        $request->validate([
            'name' => 'required|min:3|max:30',
            'username' => 'required|min:3',
            'role' => 'required',
        ]);

        if ($request->input('password')) {
            $password = Hash::make($request->password);
        } else {
            $password = Hash::make('12345678');
        }
        $users = [
            'name' => $request->name,
            'username' => $request->username,
            'password' => $password,
            'role' => $request->role,
        ];

        $user->update($users);
        alert()->success('Sukses', 'Data berhasil diubah.');
        return redirect('user');
    }


    public function destroy($id)
    {
        $user = User::find($id);
        $user->delete();
        alert()->success('Sukses', 'Data berhasil dihapus.');
        return redirect()->back();
    }
}
