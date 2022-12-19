<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{

  /**
   * Display a listing of the resource.
   *
   * @return Response
   */
  public function index(Request $request)
  {
    if ($request->get('search')) {
      $contacts = Contact::with(['clients'])->WhereHas('clients', function ($query) use ($request) {
        $query->where('name', 'like', '%' . request('search') . '%')
          ->orWhere('email',  'like', '%' . request('search') . '%');
      })
        ->orWhere('title', 'like', '%' . request('search') . '%')
        ->orWhere('content', 'like', '%' . request('search') . '%')
        ->paginate(5);
    } else {
      $contacts = Contact::with('clients')->paginate(5);
    }
    return view('admin.contacts.index', compact('contacts'));
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return Response
   */
  public function create()
  {
  }

  /**
   * Store a newly created resource in storage.
   *
   * @return Response
   */
  public function store(Request $request)
  {
  }

  /**
   * Display the specified resource.
   *
   * @param  int  $id
   * @return Response
   */
  public function show($id)
  {
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  int  $id
   * @return Response
   */
  public function edit($id)
  {
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  int  $id
   * @return Response
   */
  public function update($id)
  {
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return Response
   */
  public function destroy($id)
  {
    $contact = Contact::findOrFail($id);
    $contact->delete();
    flash()->success('Contact Deleted Successfully');
    return back();
  }
}
