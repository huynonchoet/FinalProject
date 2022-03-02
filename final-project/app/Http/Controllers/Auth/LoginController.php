<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\LoginRequest;

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
    public function postLogin(LoginRequest $request)
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
        } else {
            return back()->with('error', __('messages.error_login'));
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
