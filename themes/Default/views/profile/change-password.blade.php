@extends('profile.layout', [
    'before' => [
        'Home' => route('home'),
        'Account' => route('profile.edit'),
    ],
    'active' => __('Password & Security'),
])
@section('content')
    <h1 class="h2">{{ __('Password & Security') }}</h1>
    <p class="pt-1">{{ __('Manage your password settings and secure your account') }}.</p>
    <h2 class="h5">{{ __('Password') }}</h2>
    @session('status')
        <div class="alert alert-info">{{ session('status') }}</div>
    @endsession
    <form action="{{ route('password.update') }}" method="POST">
        @csrf
        @method('PUT')
        <div class="row align-items-end mb-2">
            <div class="col-sm-6 mb-2">
                <label class="form-label" for="account-password">{{ __('Current password') }}</label>
                <div class="password-toggle">
                    <input name="current_password" class="form-control" type="password" id="account-password" required>
                    <label class="password-toggle-btn" aria-label="{{ __('Show/hide password') }}">
                        <input class="password-toggle-check" type="checkbox">
                        <span class="password-toggle-indicator"></span>
                    </label>
                </div>
                @error('current_password')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="col-sm-6 mb-2">
                <a class="d-inline-block mb-2" href="{{ route('profile.newpassword') }}">{{ __('Forgot password?') }}</a>
            </div>
        </div>
        <div class="row mb-2">
            <div class="col-sm-6 mb-3">
                <label class="form-label" for="account-password-new">{{ __('New password') }}</label>
                <div class="password-toggle">
                    <input name="password" class="form-control" type="password" id="account-password-new" required>
                    <label class="password-toggle-btn" aria-label="Show/hide password">
                        <input class="password-toggle-check" type="checkbox"><span class="password-toggle-indicator"></span>
                    </label>
                </div>
                @error('password')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="col-sm-6 mb-3">
                <label class="form-label" for="account-password-confirm">{{ __('Confirm password') }}</label>
                <div class="password-toggle">
                    <input name="password_confirmation" class="form-control" type="password" id="account-password-confirm"
                        required>
                    <label class="password-toggle-btn" aria-label="Show/hide password">
                        <input class="password-toggle-check" type="checkbox"><span class="password-toggle-indicator"></span>
                    </label>
                </div>
            </div>
        </div>
        <button class="btn btn-outline-primary" type="submit">{{ __('Update password') }}</button>
    </form>
@endsection
