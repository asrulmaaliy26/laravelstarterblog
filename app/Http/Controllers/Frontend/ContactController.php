<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Contact;
use App\Http\Requests\Frontend\ContactRequest;

class ContactController extends Controller
{
    public function index(){
        return view('frontend.contact');
    }

    public function store(ContactRequest $request){
        if($request->validated()){
            Contact::create($request->validated());
        }
        return back()->with([
            'message' => 'successfully dsend !',
            'alert-type' => 'success'
        ]);
    }
}