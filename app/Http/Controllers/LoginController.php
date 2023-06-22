<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;

use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public static function login(Request $request): RedirectResponse
    {
        $credentials = $request->validate(
            [
                'email' => ['required', 'email'],
                'password' => 'required',
            ]
        );

        if (Auth::attempt($credentials)) {
            //Redirect admin to the main page (to download Excel file)
            if (auth()->user()->privilege == 'Admin') {
                return redirect('/');
            }

            $request->session()->regenerate();

            return redirect()->intended('ExamStart');
        }

        return back()->withErrors([
            'email' => __('Неверный email или пароль'),
        ])->onlyInput('email');
    }

    public static function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
