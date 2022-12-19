<?php

namespace App\Http\Controllers\Auth;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Models\Client;
use App\Providers\RouteServiceProvider;

use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest:web')->except('logout');
        $this->middleware('guest:clients')->except('logout');
    }

    public function showClientLoginForm()
    {
        return view('auth.login', ['route' => route('client.login-view'), 'title'=>'Client']);
    }

    public function clientLogin(Request $request)
    {
        config(['auth.defaults.guard' => 'clients']);
        $this->validate($request, [
            'phone'   => 'required',
            'password' => 'required|min:6'
        ]);
        if (\Auth::guard('clients')->attempt($request->only(['phone','password']), $request->get('remember'))){
            return redirect()->intended();
        }

        return back()->withInput($request->only('phone', 'remember'));
    }
}
