<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserSignup;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;

class GoogleController extends Controller
{

    /**
     * Redirect to google auth.
     * @param null $data
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function redirectToGoogle($data = null)
    {
        if (!empty($data)) {
            session()->put('signup_data', $data);
        }
        return Socialite::driver('google')->redirect();
    }

    /**
     * Handle auth response.
     *
     * @param Request $request
     * @return void
     */
    public function handleGoogleCallback(Request $request)
    {
        try {

            $user = Socialite::driver('google')->user();

            $userExists = User::where('email', $user->getEmail())
                ->first();

            if ($userExists) {

                if (empty($userExists->google_id)) {
                    $userExists->update(['google_id' => $user->getId()]);
                }

                Auth::login($userExists);

                session()->flash('success','Welcome '.$userExists->first_name);
                return redirect()->intended('home');

            } else {
                // new user signup
                if (session()->has('signup_data')) {
                    $inputs = session()->get('signup_data');
                    $inputs['email'] = $user->getEmail();
                    $inputs['google_id'] = $user->getId();
                    $newUser = User::create($inputs);

                    session()->forget('signup_data');
                    session()->save();

                    Auth::login($newUser);
                    session()->flash('success','You have been registered with Google');

                    return redirect()->intended('home');
                } else {
                    // show error to users those are not registered
                    session()->flash('error', 'Your are not registered! Please register.');
                    return redirect()->route('register');
                }
            }

        } catch (\Throwable $t) {
            session()->flash('error', $t->getMessage());
            return redirect()->route('register');
        }
    }

    public function signupWithGoogle(UserSignup $request)
    {
        $inputs = [
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'dob' => date('Y-m-d', strtotime($request->dob)),
            'password' => Hash::make($request->password),
            'annual_income' => $request->annual_income,
            'gender' => $request->gender,
            'occupation' => $request->occupation,
            'family_type' => $request->family_type,
            'manglik' => $request->manglik,
            'pre_min_income' => $request->pre_min_income,
            'pre_max_income' => $request->pre_max_income,
            'pre_occupation' => !empty($request->pre_occupation) ? implode(',', $request->pre_occupation) : null,
            'pre_family_type' => !empty($request->pre_family_type) ? implode(',', $request->pre_family_type) : null,
            'pre_manglik' => $request->pre_manglik,
        ];

        return $this->redirectToGoogle($inputs);
    }
}
