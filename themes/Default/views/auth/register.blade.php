<x-guest-layout :outHeader="true" :outFooter="true">
    <div class="container-fluid d-flex h-100 align-items-center justify-content-center py-sm-5 py-4">
        <div class="card card-body" style="max-width: 940px"><a
                class="position-absolute nav-link fs-sm end-0 top-0 me-3 mt-3 px-2 py-1" href="#"
                onclick="window.history.go(-1); return false;"><i
                    class="fi-arrow-long-left fs-base me-2"></i>{{ __('Go back') }}</a>
            <div class="row align-items-center mx-0">
                <div class="col-md-6 border-end-md p-sm-5 p-2">
                    <h2 class="h3 mb-sm-5 mb-4">{{ __('Join :site', ['site' => setting('site_name')]) }}<br>
                        {{ __('Get premium benefits') }}:
                    </h2>
                    <ul class="list-unstyled mb-sm-5 mb-4">
                        <li class="d-flex mb-2">
                            <i class="fi-check-circle text-primary me-2 mt-1"></i>
                            <span>{{ __('Add and promote your listings') }}</span>
                        </li>
                        <li class="d-flex mb-2">
                            <i class="fi-check-circle text-primary me-2 mt-1"></i>
                            <span>{{ __('Easily manage your wishlist') }}</span>
                        </li>
                        <li class="d-flex mb-2">
                            <i class="fi-check-circle text-primary me-2 mt-1"></i>
                            <span>{{ __('Leave reviews') }}</span>
                        </li>
                    </ul>
                    <img class="d-block mx-auto" src="{{ asset_theme('img/signup.svg') }}" width="344"
                        alt="{{ setting('site_name') }}">
                    <div class="mt-sm-4 pt-md-3">{{ __('Already have an account?') }}
                        <a href="{{ route('login') }}">{{ __('Sign in') }}</a>
                    </div>
                </div>
                <div class="col-md-6 px-sm-5 pb-sm-5 pt-md-5 px-2 pb-4 pt-2">
                    @include('auth.social_buttons')
                    <form action="{{ route('register') }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col mb-4">
                                <label class="form-label" for="signup-name">{{ __('Name') }}</label>
                                <input name="name" class="form-control @error('name') is-invalid @enderror"
                                    type="text" id="signup-name" placeholder="{{ __('Enter your name') }}"
                                    value="{{ old('name') }}" required>
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col mb-4">
                                <label class="form-label" for="signup-lastname">{{ __('Lastname') }}</label>
                                <input name="lastname" class="form-control @error('lastname') is-invalid @enderror"
                                    type="text" id="signup-lastname" placeholder="{{ __('Enter your lastname') }}"
                                    value="{{ old('lastname') }}">
                                @error('lastname')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="mb-4">
                            <label class="form-label" for="signup-email">{{ __('Email address') }}</label>
                            <input class="form-control @error('email') is-invalid @enderror" name="email"
                                type="email" id="signup-email" placeholder="{{ __('Enter your email') }}" required
                                value="{{ old('email') }}">
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-4">
                            <label class="form-label" for="signup-password">{{ __('Password') }} <span
                                    class='fs-sm text-muted'>{{ __('min. 8 char') }}</span></label>
                            <div class="password-toggle">
                                <input class="form-control" name="password" type="password" id="signup-password"
                                    minlength="8" required>
                                <label class="password-toggle-btn" aria-label="{{ __('Show/hide password') }}">
                                    <input class="password-toggle-check" type="checkbox"><span
                                        class="password-toggle-indicator"></span>
                                </label>
                            </div>
                            @error('password')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-4">
                            <label class="form-label"
                                for="signup-password-confirm">{{ __('Confirm password') }}</label>
                            <div class="password-toggle">
                                <input name="password_confirmation" class="form-control" type="password"
                                    id="signup-password-confirm" minlength="8" required>
                                <label class="password-toggle-btn" aria-label="Show/hide password">
                                    <input class="password-toggle-check" type="checkbox"><span
                                        class="password-toggle-indicator"></span>
                                </label>
                            </div>
                        </div>
                        <div class="form-check mb-4">
                            <input name="terms" class="form-check-input @error('terms') is-invalid @enderror"
                                type="checkbox" id="agree-to-terms" required>
                            @error('terms')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <label class="form-check-label" for="agree-to-terms">
                                {{ __('By joining, I agree to the') }}
                                <a href='{{ setting('site_terms_url') }}'>{{ __('Terms of use') }}</a>
                                {{ __('and') }} <a
                                    href='{{ setting('site_privacy_url') }}'>{{ __('Privacy policy') }}</a>
                            </label>
                        </div>
                        <button class="btn btn-primary btn-lg w-100" type="submit">{{ __('Sign up') }} </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-guest-layout>
