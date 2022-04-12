<?php

namespace App\Http\Controllers;

class CaptchaValidationController extends Controller
{
    public function reloadCaptcha()
    {
        return response()->json(['captcha' => captcha_img()]);
    }
}
