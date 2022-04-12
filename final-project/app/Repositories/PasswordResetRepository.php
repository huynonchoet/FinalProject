<?php

namespace App\Repositories;

use App\Interfaces\PasswordResetRepositoryInterface;
use App\Models\PasswordReset;


class PasswordResetRepository implements PasswordResetRepositoryInterface
{
    public function getPasswordResetByEmail($email)
    {
        return PasswordReset::where('email', $email)->get();
    }
    
    public function getPasswordResetByToken($token)
    {
        return PasswordReset::where('token', $token)->get();
    }

    public function updatePasswordReset($email, array $news)
    {
        return PasswordReset::where('email', $email)->update($news);
    }
    
    public function createPasswordReset(array $news)
    {
        return PasswordReset::create($news);
    }
}
