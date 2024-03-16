<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginAuthenticateRequest;
use App\Models\District;
use App\Models\Penyandang;
use App\Models\Relawan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    public function login_index()
    {
        $penyandang = Penyandang::all();
        $relawan = Relawan::all();
        $districts = District::with('relawan', 'penyandang')->get();

        return view('pages.auth.login', compact('penyandang', 'districts', 'relawan'));
    }

    public function login_authenticate(LoginAuthenticateRequest $request)
    {
        $field = filter_var($request->input('username'), FILTER_VALIDATE_EMAIL) ? 'email' : 'username';

        $credentials = [
            $field => $request->input('username'),
            'password' => $request->input('password')
        ];

        if (Auth::attempt($credentials)) {
            return redirect()
                ->route('dashboard.index')
                ->withSuccess('Selamat datang!');
        }

        return redirect()
            ->back()
            ->withErrors(['message' => 'Ups! Username atau password salah']);
    }

    public function register_index()
    {
        return view('pages.auth.register');
    }

    public function logout()
    {
        Session::flush();
        Auth::logout();

        return redirect()
            ->route('auth.login.index');
    }
}