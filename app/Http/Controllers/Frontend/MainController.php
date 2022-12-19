<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\AppSetting;
use Illuminate\Http\Request;

class MainController extends Controller
{
    public function settings()
    {
        $settings=AppSetting::findOrFail(1);
        return view('frontend.inc.navbar',compact('settings'));
    }
}
