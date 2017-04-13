<?php

namespace App\Http\Controllers;

use App\Contact;
use Illuminate\Support\Facades\Response;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function index ()
    {
      $contacts = Contact::all();
      return Response::json($contacts);
    }

    public function show ($id)
    {
      $contact = Contact::find($id);
      return Response::json($contact);
    }

    public function update (Request $request, $id)
    {
      $contact = Contact::find($id);
      $contact->update($request->all());
      return Response::json(['updated' => true]);
    }

    public function create (Request $request)
    {
      $contact = Contact::create($request->all());
      return Response::json(['created' => true]);
    }

    public function destroy ($id)
    {
      $contact = Contact::find($id);
      $contact->delete();
      return Response::json(['deleted' => true]);
    }
}
