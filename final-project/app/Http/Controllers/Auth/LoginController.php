<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\LoginRequest;
use App\Models\User;
use Exception;

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
        $user = User::where('email', $request->email)->get();
        if ($user[0]['status'] == '1') {
            return back()->with('error', __('This Email has been locked!!!'));
        }
        $login = [
            'email' => $request->email,
            'password' => $request->password
        ];
        if (Auth::attempt($login)) {
            if (Auth::user()->role == 1 || Auth::user()->role == 2) {
                return redirect()->route('admin.users.index');
            } else {
                return redirect()->route('home');
            }
        }

        return back()->with('error', __('messages.error_login'))->withInput();

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
