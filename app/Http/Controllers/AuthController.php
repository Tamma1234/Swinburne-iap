<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Session;
use App\Models\Fu\Campus;

class AuthController extends Controller
{
    /**
     * index.
     *
     * @return auth.login
     */
    public function index()
    {
        if(auth()->user() != "") {
            return redirect()->route('dashboard');
        } else {
            $campus = Campus::all();
            return view('admin.auth.login', compact('campus'));
        }
    }

    /**
     * login.
     *
     * @param Request $request
     *
     * @return dashboard
     */
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'user_email' => ['required'],
            'password' => ['required'],
        ]);
        // Ghi nhớ đăng nhập
        $remenber = $request->remember_token;

        $array_campus = config('localStorage')->campus;
        $campus = $request->campus_code;
        if (!$campus) {
            return redirect()->route('home');
        } else if (!in_array($campus, $array_campus)) {
            return redirect()->route('home');
        }
        session(['campus_db' => $campus]);
        /**
         * Dùng Auth::attempt xem email,password có trong table users k
         *  Nếu có thì dùng session để lưu, ghi nhớ thông tin login
         * Sau đó chuyển hướng đến trang dasboard
         */
        if (auth()->attempt($credentials, $remenber)) {
            $request->session()->regenerate();
            return redirect()->route('dashboard');
        }
        // Còn không sẽ trả về back và hiển thị lỗi email
        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }

    /**
     * edit.
     *
     * @return login
     */
    public function logout()
    {
        Auth::logout();
        session()->flush();
        return redirect()->route('home');
    }

}
