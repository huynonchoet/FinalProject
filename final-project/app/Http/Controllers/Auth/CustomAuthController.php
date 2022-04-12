<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Http\Requests\RegisterRequest;
use App\Interfaces\PasswordResetRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class CustomAuthController extends Controller
{
    private $passwordResetRepository;

    public function __construct(PasswordResetRepositoryInterface $passwordResetRepository)
    {
        $this->passwordResetRepository = $passwordResetRepository;
    }
    public function registration()
    {
        return view('user.register.index');
    }

    public function customRegistration(RegisterRequest $request)
    {
        $data = $request->all();
        if ($this->create($data)) {
            $email = $request['email'];
            $token = Hash::make($email);
            $passwordReset = $this->passwordResetRepository->getPasswordResetByEmail($email);
            if (count($passwordReset) == 0) {
                $this->passwordResetRepository->createPasswordReset(['email' => $email, 'token' => $token]);
            } else {
                $this->passwordResetRepository->updatePasswordReset($email, ['email' => $email, 'token' => $token]);
            }
            Mail::to($email)->send(new \App\Mail\UserActivationEmail($token));

            return redirect()->route('register.index')->with('success', 'Create successfully');
        }

        return abort(404);
    }

    public function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'status' => '1',
        ]);
    }

    public function confirmEmail(Request $request)
    {
        $resetPassword = $this->passwordResetRepository->getPasswordResetByToken($request->token);
        User::where('email', $resetPassword[0]['email'])->update(['status' => '0']);

        return view('mail.confirm_email_success');
    }
}
