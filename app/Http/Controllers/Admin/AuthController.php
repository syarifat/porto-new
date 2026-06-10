<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    // Hardcoded credentials
    private const ADMIN_USERNAME = 'syarifat';
    private const ADMIN_PASSWORD = 'matahary02';

    public function showLogin()
    {
        if (session('admin_logged_in')) {
            return redirect()->route('admin.dashboard');
        }
        return view('admin.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ], [
            'username.required' => 'Username wajib diisi.',
            'password.required' => 'Password wajib diisi.',
        ]);

        if (
            $request->username === self::ADMIN_USERNAME &&
            $request->password === self::ADMIN_PASSWORD
        ) {
            session(['admin_logged_in' => true, 'admin_username' => $request->username]);
            return redirect()->route('admin.dashboard')->with('success', 'Selamat datang, ' . $request->username . '!');
        }

        return back()->withErrors(['credentials' => 'Username atau password salah.'])->withInput();
    }

    public function logout(Request $request)
    {
        $request->session()->forget(['admin_logged_in', 'admin_username']);
        return redirect()->route('admin.login')->with('success', 'Berhasil logout.');
    }
}
