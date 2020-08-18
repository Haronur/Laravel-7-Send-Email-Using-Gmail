<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Mail\SendMail;

class EmailController extends Controller
{
    public function send_email()
    {
     $details = [
        'title' => 'Title: Artisan Sorftware Valley',
        'body' => 'Body: This is for testing email using smtp'
    ];
   
    \Mail::to('haronur@gmail.com')->send(new SendMail($details));
   	return view('emails.thanks');
    }
}
