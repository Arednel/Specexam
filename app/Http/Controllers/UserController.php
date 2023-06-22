<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Validation\Rule;

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Session;

use App\Models\User;

class userController extends Controller
{
    public function register(Request $request)
    {
        //Validate user data
        $request->validate(
            [
                'email' => ['required', 'email', Rule::unique('users', 'email')],
                'password' => 'required',
                'full_name' => 'required',
                'iin' => 'required',
                'ict' => 'required',
                'speciality' => 'required',
                'educational_institution' => 'required',
                'locale' => 'required',
            ]
        );

        $email = $request->input('email');
        $password = Hash::make($request->input('password'));
        $full_name = $request->input('full_name');
        $iin = $request->input('iin');
        $ict = $request->input('ict');
        $speciality = $request->input('speciality');
        $educational_institution = $request->input('educational_institution');

        $locale = $request->input('locale');
        switch ($locale) {
                //ru is Russian language according to ISO 639-1 codes
            case 'ru':
                $locale = 'ru';
                break;
                //kk is Kazakh language according to ISO 639-1 codes
            case 'kk':
                $locale = 'kk';
                break;
            default:
                $locale = 'ru';
                break;
        }
        //Set language
        App::setLocale($locale);
        Session::put('locale', $locale);
        Cookie::queue(Cookie::forever('locale', $locale));

        //Create with Eloquent model
        User::create([
            'email' => $email,
            'password' => $password,
            'full_name' => $full_name,
            'iin' => $iin,
            'ict' => $ict,
            'speciality' => $speciality,
            'educational_institution' => $educational_institution,
        ]);

        //Auth
        return LoginController::login($request);
    }
}
