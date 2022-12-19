<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\BloodType;
use App\Models\Client;
use App\Models\Governate;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
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
        $this->middleware('guest:web');
        $this->middleware('guest:clients');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => $data['password'],
            // 'password' => Hash::make($data['password']),
        ]);
    }

    public function showClientRegisterForm()
    {
        $bloodtypes = BloodType::all();
        $governorates = Governate::all();

        return view('auth.register', [
            'route' => route('client.register'), 'title' => 'عميل',
            'bloodtypes' => $bloodtypes,
            'governorates' => $governorates
        ]);
    }
    protected function createClient(Request $request)
    {
        config(['auth.defaults.guard' => 'clients']);
        // dd($request->all());
        $this->validate($request, [
            'name' => 'required|max:191',
            'email' => 'required|unique:clients',
            'bloodtype_id' => 'required',
            'lastdonation_date' => 'required',
            'city_id' => 'required',
            'phone' => 'required|unique:clients|min:8',
            'password' => 'required|confirmed|min:6',
            'password_confirmation' => 'required|same:password'
        ]);
        $client = Client::create($request->all());
        $client->api_token = $request->_token;
        $client->save();
        if ($request->has('governate_id')) {
            $client->governates()->attach($request->governate_id);
        }
        $client->bloodTypes()->attach($request->bloodtype_id);
        return redirect()->intended('client');
    }
}
