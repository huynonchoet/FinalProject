<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('auth.login');
    }

    /**
     * handle login
     *
     * @param LoginRequest $request
     * @return mixed
     */
    public function postLogin(Request $request)
    {
        $login = [
            'email' => $request->email,
            'password' => $request->password,
        ];
        if (Auth::attempt($login)) {
            if (Auth::user()->role == 1) {
                return redirect()->route('login');
            } else {
                return redirect()->route('home');
            }
        }
    }

    /**
     * handle logout
     *
     * @param LoginRequest $request
     * @return mixed
     */
    public function logout()
    {
        Auth::logout();

        return view('auth.login');
    }
}
