<?php

namespace App\Http\Controllers;

use App\Mail\ContactMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public function index()
    {
        return view('contact',[
            'title' => 'Trang Contact'
        ]); // View contact như bạn đã cung cấp
    }

    public function send(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'msg' => 'required|min:5',
        ]);

        $details = [
            'email' => $request->email,
            'msg' => $request->msg
        ];

        Mail::to('maithaotp234@gmail.com')->send(new ContactMail($details));

        return redirect()->route('contact.index')->with('success', 'Message sent successfully!');
    }
}
