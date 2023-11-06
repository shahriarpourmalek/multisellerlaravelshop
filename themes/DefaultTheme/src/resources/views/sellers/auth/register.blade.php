@extends('front::sellers.auth.layouts.master', ['title' => trans('front::messages.auth_sellers.register-on-the-site') ])

@section('content')

    <!-- Start main-content -->
    <main class="main-content dt-sl mt-4 mb-3">
        <div class="container main-container">

            <div class="row">
                <div class="col-xl-4 col-lg-5 col-md-7 col-12 mx-auto">
                    <div class="form-ui dt-sl dt-sn pt-4">
                        <div class="section-title title-wide mb-1 no-after-title-wide">
                            <h2 class="font-weight-bold">{{ trans('front::messages.auth_sellers.register-on-the-site') }}</h2>
                        </div>
                        <form id="register-form" action="{{ route('sellers.register') }}" method="POST">
                            @csrf
                            <div class="form-row-title">
                                <h3>{{ trans('front::messages.auth_sellers.name') }}</h3>
                            </div>
                            <div class="form-row form-group">
                                <input type="text" name="seller_name" class="input-ui pr-2" placeholder="{{ trans('front::messages.auth_sellers.enter-your-name') }}">
                            </div>

                            <div class="form-row-title">
                                <h3>{{ trans('front::messages.auth_sellers.phone-number') }}</h3>
                            </div>
                            <div class="form-row with-icon form-group">
                                <input type="text" name="username" class="input-ui pr-2" placeholder="{{ trans('front::messages.auth_sellers.enter-mobile-number') }}">
                                <i class="mdi mdi-account-circle-outline"></i>
                            </div>

                            <div class="form-row-title">
                                <h3>{{ trans('front::messages.auth_sellers.password') }}</h3>
                            </div>
                            <div class="form-row with-icon form-group">
                                <input id="password" type="password" name="password" class="input-ui pr-2" placeholder="{{ trans('front::messages.auth_sellers.enter-your-password') }}">
                                <i class="mdi mdi-lock-open-variant-outline"></i>
                            </div>

                            <div class="form-row-title">
                                <h3>{{ trans('front::messages.auth_sellers.repeat-the-password') }}</h3>
                            </div>
                            <div class="form-row form-group">
                                <input type="password" name="password_confirmation" class="input-ui pr-2" placeholder="{{ trans('front::messages.auth_sellers.repeat-your-password') }}">
                            </div>


                            <div class="form-row mt-4">
                                <div class="col-md-8 col-6">
                                    <div class="form-group">
                                        <input type="text" class="input-ui pl-2 captcha" autocomplete="off" name="captcha" placeholder="{{ trans('front::messages.auth_sellers.security-code') }}" required>
                                    </div>
                                </div>
                                <div class="col-md-4 col-6">
                                    <img class="captcha w-100" src="{{ captcha_src('flat') }}" alt="captcha">
                                </div>
                            </div>

                            <div class="form-row mt-3">
                                <button class="btn-primary-cm btn-with-icon mx-auto w-100">
                                    <i class="mdi mdi-account-circle-outline"></i>
                                    {{ trans('front::messages.auth_sellers.register-on-the-site') }}
                                </button>
                            </div>

                            <div class="form-footer text-right mt-3">
                                <span class="d-block font-weight-bold">{{ trans('front::messages.auth_sellers.have-you-registered-before') }}</span>
                                <a href="{{ route('sellers.login') }}" class="d-inline-block mr-3 mt-2">{{ trans('front::messages.auth_sellers.enter') }}</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </main>
    <!-- End main-content -->

@endsection

@push('scripts')
    <script>
        var redirect_url = '{{ request("redirect") ?: Redirect::intended()->getTargetUrl() }}';
    </script>

    <script src="{{ theme_asset('js/pages/sellers_register.js') }}?v=2"></script>
@endpush