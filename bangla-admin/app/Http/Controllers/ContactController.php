<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;

class ContactController extends Controller
{
    public function index(){
        $contactList = Contact::get();
        return view('admin.contact.index', compact('contactList'));
    }
    public function create(){
        return view('admin.contact.create');
    }

    public function store(Request $request){
        $request->validate([
            'contact_info' => 'required'
        ]);

        $contact = new Contact();
        $contact->contact_info = $request->contact_info;

        $contact->save();

        return redirect('/admin/contact/index');
    }

    public function delete($id){
        $contact = Contact::where('id', $id)->first();
        $contact->delete();

        return back();
    }

}
