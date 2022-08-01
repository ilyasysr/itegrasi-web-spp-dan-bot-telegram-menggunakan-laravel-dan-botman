<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class GantiPasswordController extends Controller
{
    public function index()
    {
        return view('auth.passwords.gantipassword');
    }
    public function update()
    {
        request()->validate([
            'old_password' => 'required',
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        $new_password = auth()->user()->password;
        $old_password = request('old_password');

        if (Hash::check($old_password, $new_password)) {

            auth()->user()->update([
                'password' => Hash::make(request('password')),
            ]);
            session()->flash('success', 'Password berhasil diubah.');
            return redirect('/');
        } else {
            return back()->withErrors(['old_password' => 'Password lama yang anda masukan salah!']);
        }
    }
}
