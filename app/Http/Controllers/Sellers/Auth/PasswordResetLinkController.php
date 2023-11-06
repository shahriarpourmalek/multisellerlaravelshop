<?php

namespace App\Http\Controllers\Sellers\Auth;

use App\Http\Controllers\Controller;
use App\Models\OneTimeCode;
use App\Models\Seller;
use App\Models\User;
use App\Notifications\Sms\VerifyCodeSent;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Password;

class PasswordResetLinkController extends Controller
{
    public function create()
    {
        $view = config('front.sellers.forgot-password');
        if (!$view || option('forgot_password_link', 'off') == 'off') {
            abort(404);
        }

        return view($view);
    }

    public function store(Request $request)
    {
        $request->validate([
            'mobile' => 'required|exists:sellers,username',
            'captcha' => ['required', 'captcha'],
        ]);
        $seller = Seller::where('username', $request->mobile)->first();

        $this->sendCode($seller);

        return response('success');
    }

    public static function sendCode(Seller $seller)
    {
        $verify_code = OneTimeCode::where('user_id', $seller->id)->latest()->first();

        if ($verify_code) {
            $now = Carbon::now();
            $time = $verify_code->created_at;

            if ($time->diffInSeconds($now) < 120) {
                return;
            }
        }

        // send sms notification to user
        Notification::send($seller, new VerifyCodeSent($seller));
    }
}
