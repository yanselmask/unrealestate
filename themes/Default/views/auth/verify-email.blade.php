<x-guest-layout :outHeader="true" :outFooter="true">
    <div class="container-fluid d-flex h-100 align-items-center justify-content-center py-sm-5 py-4">
        <div class="card card-body" style="max-width: 940px">
            <a class="position-absolute nav-link fs-sm end-0 top-0 me-3 mt-3 px-2 py-1" href="#"
                onclick="window.history.go(-1); return false;"><i
                    class="fi-arrow-long-left fs-base me-2"></i>{{ __('Go back') }}</a>
            <div class="row align-items-center mx-0">
                <div class="col-md-6 border-end-md p-sm-5 p-2">
                    <span class="mb-sm-5 mb-4">
                        {{ __('Thanks for signing up! Before getting started, could you verify your email address by clicking on the link we just emailed to you? If you didn\'t receive the email, we will gladly send you another.') }}
                    </span>
                    <img class="d-block mx-auto" src="{{ asset_theme('img/signin.svg') }}" width="344"
                        alt="{{ setting('site_name') }}">
                </div>
                <div class="col-md-6 px-sm-5 pb-sm-5 pt-md-5 px-2 pb-4 pt-2">

                    <div class="card">
                        <div class="card-header">{{ __('Verify Your Email Address') }}</div>

                        <div class="card-body">
                            @if (session('status') == 'verification-link-sent')
                                <div class="alert alert-success" role="alert">
                                    {{ __('A fresh verification link has been sent to your email address.') }}
                                </div>
                            @endif

                            {{ __('Before proceeding, please check your email for a verification link.') }}
                            {{ __('If you did not receive the email') }},
                            <form class="d-inline" method="POST" action="{{ route('verification.send') }}">
                                @csrf
                                <button type="submit"
                                    class="btn btn-link m-0 p-0 align-baseline">{{ __('click here to request another') }}</button>.
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-guest-layout>
