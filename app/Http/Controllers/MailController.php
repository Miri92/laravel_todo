<?php

namespace App\Http\Controllers;

use App\Mail\SendMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class MailController extends Controller
{

    public function index()
    {
        return view('home');
    }

    public function test()
    {
        //Mail::to(config('app.admin_mail'))->send(new SendMail());

        Mail::to(config('app.admin_mail'))->queue(new SendMail());
    }
}
