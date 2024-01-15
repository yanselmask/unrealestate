<x-guest-layout :outHeader="true" :outFooter="true">
    <div class="container-fluid d-flex h-100 align-items-center justify-content-center py-sm-5 py-4">
        <div class="card card-body" style="max-width: 940px">
            <a class="position-absolute nav-link fs-sm end-0 top-0 me-3 mt-3 px-2 py-1" href="#"
                onclick="window.history.go(-1); return false;"><i
                    class="fi-arrow-long-left fs-base me-2"></i>{{ __('Go back') }}</a>
            <div class="row align-items-center mx-0">
                <div class="col-md-6 border-end-md p-sm-5 p-2">
                    <h2 class="h3 mb-sm-5 mb-4">{{ __('Did you forget your password') }}</h2>
                    <img class="d-block mx-auto" src="{{ asset_theme('img/signin.svg') }}" width="344"
                        alt="{{ setting('site_name') }}">
                    <div class="mt-sm-5 mt-4">{{ __('Already have an account?') }} <a
                            href="{{ route('login') }}">{{ __('Sign in here') }}</a>
                    </div>
                </div>
                <div class="col-md-6 px-sm-5 pb-sm-5 pt-md-5 px-2 pb-4 pt-2">
                    @session('status')
                        <div class="alert alert-info">{{ session('status') }}</div>
                    @endsession
                    <form action="{{ route('password.email') }}" method="POST">
                        @csrf
                        <div class="mb-4">
                            <label class="form-label mb-2" for="signin-email">{{ __('Email address') }}</label>
                            <input class="form-control @error('email') is-invalid @enderror" name="email"
                                type="email" id="signin-email" placeholder="{{ __('Enter your email') }}" required
                                value="{{ old('email') }}">
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <button class="btn btn-primary btn-lg w-100"
                            type="submit">{{ __('Restore password') }}</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-guest-layout>
