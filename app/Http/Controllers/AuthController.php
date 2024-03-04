<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Middleware\IsUser;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    public function index()
    {
        return view('login');
    }

    public function Ceklogin(Request $request)
    {
        $request -> validate([
            'email' => 'required|email',
            'password' => 'required|string|min:6',
        ]);

        if (Auth::attempt(['email'=> $request->email,'password'=> $request->password])) {
            $request->session()->regenerate();
            return redirect('/explore');
        } else {
        return redirect()->back()->with('error', 'Email atau password salah');
        }
    }

    public function regi(Request $request)
    {
        return view('register');
    }

    public function register(Request $request)
    {
        $pesan = [
            'email.required' => 'Email tidak boleh kosong',
            'email.unique'  => 'Email telah terdaftar',
            'password.required' => 'Password tidak boleh kosong',
            'password.min' => 'Password kurang dari 6',
            'no_telp.required' => 'Nomor telepon tidak boleh kosong',
            'no_telp.min' => 'Nomor telepon kurang dari 12',
            ];

        $request->validate([
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6',
            'no_telp' => 'required',
        ], $pesan);

    // Menggunakan awalan acak untuk username
    $username = 'User' . Str::random(5);

    $datastore = [
        'email' => $request->email,
        'password' => Hash::make($request->password),
        'no_telp' => $request->no_telp,
        'user_name' => $username,
        'picture' => 'users.jpg', 

    ];
        User::create($datastore);
        return redirect('login')->with('success', 'data berhasil di simpan');
    }

    public function logout(Request $request)
    {
        $request->session()->invalidate();
        $request->session()->regenerate();
        return redirect("/");
    }
}
