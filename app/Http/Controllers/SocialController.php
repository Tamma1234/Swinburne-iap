<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Validator, Redirect, Response, File;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class SocialController extends Controller
{
    public function redirect(Request $request)
    {
        $array_campus = config('localStorage')->campus;
        $campus = $request->campus_id;
        if (!$campus) {
            return redirect()->route('home');
        } else if (!in_array($campus, $array_campus)) {
            return redirect()->route('home');
        }
        session(['campus_db' => $campus]);

        return Socialite::driver('google')->stateless()->redirect();
    }

    public function callback(Request $request)
    {
        $user = Socialite::driver('google')->stateless()->user();
        $user = User::where('user_email', $user->email)->first();
//        dd($user);
        if ($user) {
            Auth::login($user);
            $request->session()->put('user_email', $user->user_email);

            return redirect()->route('rooms.index');
        } else {
            return redirect()->route('home');
        }
    }
}
