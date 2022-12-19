<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BloodType;
use App\Models\Category;
use App\Models\Governate;
use App\Models\AppSetting;

class MainControllor extends Controller
{
  //governartes
  public function governorates()
  {
    $data = Governate::all();
    return apiResponse(1, "success", $data);
  }
  //getCities
  public function cities(Request $req)
  {
    $data = Governate::with('cities')->where(function ($query) use ($req) {
      if ($req->has('id')) {
        $query->where('id', $req->governate_id);
      }
    })->get();
    return apiResponse(1, "success", $data);
  }

  //categories
  public function categories()
  {
    $data = Category::all();
    return apiResponse(1, "success", $data);
  }
  //bloodTypes
  public function BloodTypes()
  {
    $data = BloodType::all();
    return apiResponse(1, "success", $data);
  }
  //appSetting---
  public function appSetting()
  {
    $data = AppSetting::first();
    return apiResponse(1, "success", $data);
  }







  //--------

}
