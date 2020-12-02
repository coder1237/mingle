<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

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
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param array $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'dob' => ['required', 'date'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'annual_income' => ['required', 'numeric', 'between:1,100000000.00'],
            'gender' => ['required', Rule::in(['male', 'female'])],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param array $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        return User::create([
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'email' => $data['email'],
            'dob' => date('Y-m-d', strtotime($data['dob'])),
            'password' => Hash::make($data['password']),
            'annual_income' => $data['annual_income'],
            'gender' => $data['gender'],
            'occupation' => $data['occupation'],
            'family_type' => $data['family_type'],
            'manglik' => $data['manglik'],
            'pre_min_income' => $data['pre_min_income'],
            'pre_max_income' => $data['pre_max_income'],
            'pre_occupation' => !empty($data['pre_occupation']) ? implode(',', $data['pre_occupation']) : null,
            'pre_family_type' => !empty($data['pre_family_type']) ? implode(',', $data['pre_family_type']) : null,
            'pre_manglik' => $data['pre_manglik'],
        ]);
    }

    protected function registered(Request $request, $user)
    {
        session()->flash('success', 'Registration successful');
    }
}
