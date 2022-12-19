<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Mail\ResetPassword;
use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Laravel\Ui\Presets\React;

class ClientController extends Controller
{
    // use ResetsPasswords;
    
    public function logout(Request $request)
    {
        if (Auth::guard('clients')->check()) {
            Auth::guard('clients')->logout();
            return redirect()->route('/');
        }

        $this->guard()->logout();
        $request->session()->invalidate();

        return $this->loggedOut($request) ?: redirect('/');
    }
    public function showEmail()
    {
        return view('auth.passwords.email', [
            'route' => route('client.verifyemail')
        ]);
    }
    public function VerifyEmail(Request $request)
    {
        
        $this->validate($request, [
            'phone' => 'required',
        ]);

        $user = Client::where('phone', $request->phone)->first();
        if ($user) {
            $code = rand(1111, 9999);
            $user->pin_code = $code;
            $user->save();
            if ($user->pin_code == $code) {
                Mail::to($user->email)
                    ->bcc("doaabakhiet11@gmail.com")
                    ->send(new ResetPassword($user));
                flash()->success('برجاء فحص الهاتف');
                return back();
            } else {
                return back();
            }
        } else {
            flash()->success('This Phone Not Exist');
            return back();
        }
    }

    public function showForgetPassword($token,$email){
        return view('auth.passwords.reset',['route'=>route('client.updatePassword'),'token'=>$token,'email'=>$email]);
    }
    public function updatePassword(Request $request)
    {
        // dd($request->all());
        $this->validate($request, [
            'token' => ['required'],
            'email' => ['required', 'string', 'email', 'max:255'],
            'password_confirmation' => ['required','min:6'],
        ]);   

        $client = Client::where('pin_code', $request->token)->first();
        $update = $client->update([
            'password' => $request->password,
            'password_confirmation' => $request->password_confirmation,
        ]);
        if ($update) {
            flash()->success('تم تغيير كلمة المرور بنجاح');
            if (\Auth::guard('clients')->attempt($request->only(['email','password']), $request->get('remember'))){
                return redirect()->intended();
            }
        } else {
            flash()->success('حدث خطأ برجاء حاول مرة اخرى');
            return redirect()->route('/');
        }


    }
}
