<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Http\Requests\RegisterRequest;

class CustomAuthController extends Controller
{
    public function registration()
    {
        return view('user.register.index');
    }

    public function customRegistration(RegisterRequest $request)
    {  
        $data = $request->all();
        if($this->create($data)){
            dd('Huy ne');
        }

        return abort(404);
    }

    public function create(array $data)
    {
    return User::create([
        'user_name' => $data['username'],
        'email' => $data['email'],
        'password' => bcrypt($data['password'])
    ]);
    }
}
