<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Governate;
use Illuminate\Http\Request;

class GovernorateController extends Controller
{

  /**
   * Display a listing of the resource.
   *
   * @return Response
   */
  public function index()
  {
    $governorates = Governate::paginate(5);
    return view('admin.governorates.index', compact('governorates'));
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return Response
   */
  public function create()
  {
    return view('admin.governorates.add_governorate');
  }

  /**
   * Store a newly created resource in storage.
   *
   * @return Response
   */
  public function store(Request $request)
  {
    $this->validate($request, [
      'name' => 'required',
    ]);
    $governorate=Governate::create($request->except('_token'));
    flash()->success('Governorate Added Successfully');
    return redirect(route('dashboard.governorate.index'));
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
    $governorate=Governate::findOrFail($id);
    return view('admin.governorates.edit_governorate',compact('governorate'));
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  int  $id
   * @return Response
   */
  public function update(Request $request,$id)
  {
    $governorate=Governate::findOrFail($id);
    $governorate->update($request->all());
    flash()->success('Governorate Updated Successfully');
    return redirect(route('dashboard.governorate.index'));
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return Response
   */
  public function destroy($id)
  {
    $governorate=Governate::findOrFail($id);
    $governorate->delete();
    flash()->success('Governorate Deleted Successfully');
    return back();
  }
}
