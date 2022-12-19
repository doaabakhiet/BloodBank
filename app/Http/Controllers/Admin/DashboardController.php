<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class DashboardController extends Controller
{
    public function index(){
        return view('admin.index');
    }
    public function changePassword()
    {
        return view('admin.change_password');
    }
    public function updatePassword(Request $request)
    {
        $this->validate($request, [
            'password' => 'required|min:6',
            'confirm_password'=>'required|same:password',
            'old_password' => 'required',
          ]);
        $user=User::findOrFail(Auth::user()->id);
        if(Hash::check($request->old_password, $user->password)){
            $user->password=$request->password;
            $user->save();
            flash()->success('تم تغيير كلمة المرور بنجاح');
        }
        else{
            flash()->success('كلمة المرور غير صحيحة');
        }
        return redirect()->back();        
    }
}
