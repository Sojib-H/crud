<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mail\TestMail;
use Auth;

class mailController extends Controller
{
    public function sendMail()
    {
        
        $details = [
            'title'=>'Mail from Sojib Hossain',
            'body' =>'This is for testing email using smtp'
        ];
        \Mail::to('sojibhossain653@gmail.com')->send(new TestMail($details));
        return "Email has been sent";
    }
}
