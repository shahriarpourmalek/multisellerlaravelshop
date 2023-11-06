<?php

namespace App\Http\Controllers\Sellers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Sellers\Auth\SellerRegisterRequest;
use App\Models\Referral;
use App\Models\Seller;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class RegisteredSellerController extends Controller
{
    /**
     * Display the registration view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $view = config('front.sellers.register');

        if (!$view) {
            abort(404);
        }

        return view($view);
    }

    /**
     * Handle an incoming registration request.
     *

     */
    public function store(SellerRegisterRequest $request)
    {
        $data = $request->validated();
        $data['password'] = Hash::make($data['password']);
//        $data['referral_code'] = Referral::generateCode();
//
//        if ($request->referral_code && option('user_refrral_enable', 0) == 1) {
//            $data['referral_id'] = Seller::where('referral_code', $request->referral_code)->first()->id;
//        }

        $seller = Seller::create($data);
        event(new Registered($seller));

        Auth::guard('sellers')->login($seller);
        return response('success');
    }
}
