<?php 

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DonationRequest;
use Illuminate\Http\Request;

class DonationRequestController extends Controller 
{

  /**
   * Display a listing of the resource.
   *
   * @return Response
   */
  public function index(Request $request)
  {
    $donnations = DonationRequest::where(function($query) use($request){
      if($request->search){
        $query->WhereHas('cities', function ($query) use ($request) {
          $query->where('name', 'like', '%' . request('search') . '%')
          ->orWhereHas('governates', function ($query) use ($request) {
            $query->where('name', 'like', '%' . request('search') . '%');
          });
  
        })->orWhereHas('bloodtype', function ($query) use ($request) {
            $query->where('name', 'like', '%' . request('search') . '%');
          })->orWhereHas('clients', function ($query) use ($request) {
            $query->where('name', 'like', '%' . request('search') . '%');
          })
          ->orWhere('name', 'like', '%' . request('search') . '%')
          ->orWhere('age', 'like', '%' . request('search') . '%')
          ->orWhere('notes', 'like', '%' . request('search') . '%')
          ->orWhere('phone', 'like', '%' . request('search') . '%');
      }
    })->paginate(5);
  return view('admin.donnationRequests.index', compact('donnations'));
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
    $donnation=DonationRequest::findOrFail($id);
    return view('admin.donnationRequests.show_donnation_detail',compact('donnation'));
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
        $donnation=DonationRequest::findOrFail($id);
        $donnation->delete();
        flash()->success('Donnation Request Deleted Successfully');
        return back();
  }
  
}
