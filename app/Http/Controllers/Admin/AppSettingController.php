<?php 

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\AppSetting;
use Illuminate\Http\Request;

class AppSettingController extends Controller 
{

  /**
   * Display a listing of the resource.
   *
   * @return Response
   */
  public function index()
  {
    
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
  public function edit(Request $request,$id)
  {
        $setting=AppSetting::findOrFail($id);
        return view('admin.appSettings.edit_setting',compact('setting'));
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  int  $id
   * @return Response
   */
  public function update(Request $request,$id)
  {
    $this->validate($request, [
      'phone' => 'required|min:10',
      'email' => 'required|email',
      'facebook' => 'required',
      'instagram' => 'required',
      'youtube' => 'required',
      'twitter' => 'required',
      'about_app' => 'required',
    ]);
    $setting=AppSetting::findOrFail($id);
    $setting->update($request->all());
    flash()->success('Setting Updated Successfully');
    return redirect(route('dashboard.settings.edit',1));
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return Response
   */
  public function destroy($id)
  {
    
  }
  
}

?>