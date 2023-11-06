<?php

namespace App\Http\Controllers\Sellers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class NewPasswordController extends Controller
{
    public function show()
    {
        return view('back.auth.change-password');
    }

    public function store(Request $request)
    {
        $request->validate([
            'password' => 'required|string|confirmed|min:8',
        ]);

        auth('sellers')->user()->update([
            'password' => Hash::make($request->password),
            'remember_token' => Str::random(60),
            'force_to_password_change' => false,
        ]);

        DB::table('sessions')->where('user_id', auth('sellers')->user()->id)->delete();
        Auth::guard('sellers')->loginUsingId(auth('sellers')->user()->id);

        return response('success');
    }
}
