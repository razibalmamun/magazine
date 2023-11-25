<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Contact;

class ContactController extends Controller
{
    public function getAllContact($limit=10): \Illuminate\Http\JsonResponse
    {
        $contact = Contact::take($limit)->orderBy('contact_info')->get();
        return response()->json($contact);
    }

    public function getContact($id){
        $contact = Contact::find($id);

        return response()->json($contact);
    }
}
