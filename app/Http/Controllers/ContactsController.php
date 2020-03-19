<?php

namespace App\Http\Controllers;

use App\Contacts;
use App\Http\Requests\AddContactRequest;
use Illuminate\Http\Request;

class ContactsController extends Controller
{
    public function getIndex()
    {
    	$contacts = Contacts::orderBy('created_at','desc')->paginate(10);
    	return view('backend.contacts.index', [
    		'contacts' => $contacts
    	]);
    }
    public function postAdd(AddContactRequest $request)
    {
    	$contact = new Contacts;
        $contact = Contacts::create([
            'name' => $request->name,
            'phone' => $request->phone,
            'email' => $request->email,
            'title' => $request->title,
            'content' => $request->post('content')
        ]);
    	return response()->json($contact, 200);
    }
    public function getDelete($id)
    {
        $contact = Contacts::findOrFail($id);
        $contact->delete();
        return response()->json($contact, 200);
    }
}
