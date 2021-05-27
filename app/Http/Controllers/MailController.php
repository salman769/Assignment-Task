<?php

namespace App\Http\Controllers;

use App\Mail\signupEmail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class MailController extends Controller
{
    public static function sendSignupEmail($name, $email, $verification_code){
        $data = [
            'name'=> $name,
            'verification_code'=> $verification_code,
        ];
        // $request =  Mail::to($email)->send(new signupEmail($data));
        // dd($request);
    }
}
