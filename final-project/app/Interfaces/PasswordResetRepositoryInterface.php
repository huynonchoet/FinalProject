<?php

namespace App\Interfaces;

interface PasswordResetRepositoryInterface
{
    public function getPasswordResetByEmail($email);
    public function getPasswordResetByToken($token);
    public function updatePasswordReset($email, array $news);
    public function createPasswordReset(array $news);
}
