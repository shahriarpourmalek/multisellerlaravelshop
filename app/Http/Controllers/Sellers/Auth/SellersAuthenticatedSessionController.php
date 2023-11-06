<?php

namespace App\Http\Controllers\Sellers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Sellers\Auth\SellersLoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class SellersAuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $view = config('front.sellers.login') ?: 'back.auth.login';

        return view($view);
    }


    /**
     * @param SellersLoginRequest $request
     * @return Application|ResponseFactory|Response
     * @throws ValidationException
     */
    public function store(SellersLoginRequest $request)
    {
        $request->authenticate();

        $request->session()->regenerate();
        $request->session()->put('auth.password_confirmed_at', time());

        return response('success');
    }

    /**
     * Destroy an authenticated session.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Request $request)
    {
        dd('kose nane doruq go');
        Auth::guard('sellers')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
