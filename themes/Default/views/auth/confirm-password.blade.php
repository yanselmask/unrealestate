<x-guest-layout :outHeader="true" :outFooter="true">
    <div class="container-fluid d-flex h-100 align-items-center justify-content-center py-sm-5 py-4">
        <div class="card card-body" style="max-width: 940px">
            <a class="position-absolute nav-link fs-sm end-0 top-0 me-3 mt-3 px-2 py-1" href="#"
                onclick="window.history.go(-1); return false;"><i
                    class="fi-arrow-long-left fs-base me-2"></i>{{ __('Go back') }}</a>
            <div class="row align-items-center mx-0">
                <div class="col-md-6 border-end-md p-sm-5 p-2">
                    <h5 class="h5 mb-sm-5 mb-4">
                        {{ __('This is a secure area of the application. Please confirm your password before continuing.') }}
                    </h5>
                    <img class="d-block mx-auto" src="{{ asset_theme('img/signin.svg') }}" width="344"
                        alt="{{ setting('site_name') }}">
                </div>
                <div class="col-md-6 px-sm-5 pb-sm-5 pt-md-5 px-2 pb-4 pt-2">

                    <form action="{{ route('password.confirm') }}" method="POST">
                        @csrf
                        <div class="mb-4">
                            <label class="form-label mb-2" for="signin-password">{{ __('Password') }}</label>
                            <input class="form-control @error('password') is-invalid @enderror" name="password"
                                type="password" id="signin-email" placeholder="{{ __('Enter your password') }}" required
                                value="{{ old('password') }}">
                            @error('password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <button class="btn btn-primary btn-lg w-100" type="submit">{{ __('Confirm') }}</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-guest-layout>
