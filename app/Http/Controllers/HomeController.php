<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user = \auth()->user();

        // 1. logged-in user preferences
        $partners = User::where('id', '!=', $user->id)
            ->where('gender', '!=', $user->gender)
            ->where('annual_income', '>=', $user->pre_min_income)
            ->where('annual_income', '<=', $user->pre_max_income);

        if (!empty($user->pre_family_type)) {
            $partners = $partners->whereIn('family_type', explode(',', $user->pre_family_type));
        }

        if (!empty($user->pre_occupation)) {
            $partners = $partners->whereIn('occupation', explode(',', $user->pre_occupation));
        }

        // 2. matched partner's preferences
        $partners = $partners->where('pre_min_income','<=',$user->annual_income)
            ->where('pre_max_income','>=',$user->annual_income);
        $partners = $partners->get();

        $partners = collect($partners)->filter(function ($partner) use($user){

            // occupation filter
            if(!empty($partner->pre_occupation) && !empty($user->occupation)){
                $prefOccupations = explode(',',$partner->pre_occupation);
                if(!in_array($user->occupation,$prefOccupations)){
                    return false;
                }
            }

            // manglik filter
            if(isset($partner->pre_manglik) && isset($user->manglik)){
                if($partner->pre_manglik != 2 && $user->manglik != $partner->pre_manglik){
                    return false;
                }

                if($user->pre_manglik != 2 &&  $partner->manglik != $user->pre_manglik){
                    return false;
                }
            }

            // family type filter
            if(!empty($partner->pre_family_type) && !empty($user->family_type)){
                $prefFamilyTypes = explode(',',$partner->pre_family_type);
                if(!in_array($user->family_type,$prefFamilyTypes)){
                    return false;
                }
            }

            return true;
        });

        $date['partners'] = $partners;
        return view('home', $date);
    }
}
