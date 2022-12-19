<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Client;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->get('search')) {
            $clients = Client::WhereHas('cities', function ($query) use ($request) {
              $query->where('name', 'like', '%' . request('search') . '%')
              ->orWhereHas('governates', function ($query) use ($request) {
                $query->where('name', 'like', '%' . request('search') . '%');
              });

            })->orWhereHas('bloodType', function ($query) use ($request) {
                $query->where('name', 'like', '%' . request('search') . '%');
              })
              ->orWhere('name', 'like', '%' . request('search') . '%')
              ->orWhere('email', 'like', '%' . request('search') . '%')
              ->orWhere('phone', 'like', '%' . request('search') . '%')
              ->paginate(5);
          } else {
            $clients = Client::paginate(5);
          }
        return view('admin.clients.index', compact('clients'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $clients = Client::all();
        return view('admin.clients.addClient', compact('clients'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $client=Client::findOrFail($id);
        $client->delete();
        flash()->success('Client Deleted Successfully');
        return back();
    }

    public function toggleActive(Request $request){
        $id=$request->get('id');
        $client=Client::findOrFail($id);
        if($client->isactive=='1'){
            $client->isactive='0';
        }else{
            $client->isactive='1';
        }
        $client->save();
        return response()->json(['active'=>$client->isactive]);

    }
}
