<?php

namespace App\Http\Controllers\Auth;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Customer;
use Illuminate\Http\Request;
use App\Models\CustomerAddress;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

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
        $this->middleware('guest');
        $this->middleware('guest:customer');
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
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validatorCustomer(Request $request, $back_validate = null)
    {
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:customers'],
            'password' => ['required', 'string', 'min:8', 'max:255'],
            'phone' => ['required', 'string', 'min:13', 'max:255'],
            'cpf' => ['required', 'string', 'min:14', 'unique:customers', 'max:255'],
            'birthday' => ['required', 'date_format:d/m/Y', 'before:18 years ago', 'min:10'],
            'address' => ['required', 'string', 'max:255'],
            'number' => ['required', 'string', 'max:255'],
            'zipcode' => ['required', 'string', 'min:9', 'max:255'],
            'complement' => ['required', 'string', 'max:255'],
            'neighbourhood' => ['required', 'string', 'max:255'],
            'city' => ['required', 'string', 'max:255'],
            'state' => ['required', 'string', 'max:255'],
            'reference' => ['required', 'string', 'max:255'],
        ]);

        if (!$back_validate) {
            return response()->json(['error'=>$validator->errors()->get($request->keys()[0])]);
        }

        return $validator;
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
            'password' => Hash::make($data['password']),
        ]);
    }

    public function showCustomerRegisterForm()
    {
        return view('auth.customer-register');
    }

    protected function createCustomer(Request $request)
    {
        $birthday = Carbon::createFromFormat('d/m/Y', $request->birthday)->format('Y-m-d');

        $back_validate = true;

        $this->validatorCustomer($request, $back_validate)->validate();

        $customer_id = Customer::create([
            'name' => $request->name,
            'email' => $request->email,
            'cpf' => $request->cpf,
            'phone' => $request->phone,
            'birthday' => $birthday,
            'password' => Hash::make($request->password),
            'ip' => getRealCustomerIp(),
        ])->id;

        CustomerAddress::create([
            'customer_id' => $customer_id,
            'zipcode' => $request->zipcode,
            'address' => $request->address,
            'number' => $request->number,
            'complement' => $request->complement,
            'neighbourhood' => $request->neighbourhood,
            'city' => $request->city,
            'state' => $request->state,
            'reference' => $request->reference,
        ]);
        
        return redirect()->intended('/login');
    }
}
