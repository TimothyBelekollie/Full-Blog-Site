<?php

namespace App\Http\Controllers;

use App\Mail\contact;
use Illuminate\Http\Request;
use Illuminate\Mail\Mailable;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    //
    public function index(){
        return view('contact');
    }
    public function store(Request $request){
     $data= $request->validate([
            'name'=>'required',
            'email'=>'required|email',
            'subject'=>'required',
            'message'=>'required',
        ]);
        mail::to('belekollietimothy2@gmail.com')->send(new contact($data));
        return redirect(route('contact.index'))->with('success','Thank you, we will be in touch soon');

    }
}
