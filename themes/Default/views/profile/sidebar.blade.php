<aside class="col-lg-4 col-md-5 pe-xl-4 mb-5">
    <!-- Account nav-->
    <div class="card card-body me-lg-1 border-0 pb-1 shadow-sm">
        <div class="d-flex d-md-block d-lg-flex align-items-start pt-lg-2 mb-4">
            <img style="height: 48px;width: 48px;object-fit: cover;" class="rounded-circle"
                src="{{ $user->profile_photo_url }}" alt="{{ $user->fullname }}">
            <div class="pt-md-2 pt-lg-0 ps-md-0 ps-lg-3 ps-3">
                <h2 class="fs-lg mb-0">{{ $user->fullname }}</h2>
                <span class="star-rating">
                    @for ($i = 1; $i <= Number::forHumans($user->reviewsAvg); $i++)
                        <i class="star-rating-icon fi-star-filled active"></i>
                    @endfor
                    @for ($i = Number::forHumans($user->reviewsAvg) + 1; $i <= 5; $i++)
                        <i class="star-rating-icon fi-star-filled"></i>
                    @endfor
                </span>
                <ul class="list-unstyled fs-sm mb-0 mt-3">
                    @if ($user->phone)
                        <li>
                            <a class="nav-link fw-normal p-0" href="tel:{{ $user->phone }}">
                                <i class="fi-phone me-2 opacity-60"></i>{{ $user->phone }}
                            </a>
                        </li>
                    @endif
                    <li>
                        <a class="nav-link fw-normal p-0" href="mailto:{{ $user->email }}">
                            <i class="fi-mail me-2 opacity-60"></i>{{ $user->email }}
                        </a>
                    </li>
                </ul>
            </div>
        </div>
        <a class="btn btn-primary btn-lg w-100 mb-3" href="{{ route('home.listing.add') }}"><i
                class="fi-plus me-2"></i>{{ __('Add property') }}
        </a>
        <a class="btn btn-outline-secondary d-block d-md-none w-100 mb-3" href="#account-nav"
            data-bs-toggle="collapse"><i class="fi-align-justify me-2"></i>{{ __('Menu') }}
        </a>
        <div class="d-md-block collapse mt-3" id="account-nav">
            <div class="card-nav">
                <a class="card-nav-link {{ set_active('profile.edit') }}" href="{{ route('profile.edit') }}">
                    <i class="fi-user me-2 opacity-60"></i>{{ __('Personal Info') }}
                </a>
                <a class="card-nav-link {{ set_active('profile.password') }}"
                    href="{{ route('profile.password') }}"><i
                        class="fi-lock me-2 opacity-60"></i>{{ __('Password & Security') }}
                </a>
                <a class="card-nav-link {{ set_active('profile.listing') }}"
                    href="{{ route('profile.listing') }}?status=published">
                    <i class="fi-home me-2 opacity-60"></i>{{ __('My Properties') }}
                </a>
                <a class="card-nav-link {{ set_active('profile.wishlist') }}" href="{{ route('profile.wishlist') }}">
                    <i class="fi-heart me-2 opacity-60"></i>{{ __('Wishlist') }}
                </a>
                <a class="card-nav-link {{ set_active('profile.reviews') }}" href="{{ route('profile.reviews') }}">
                    <i class="fi-star me-2 opacity-60"></i>{{ __('Reviews') }}
                </a>
                <a class="card-nav-link {{ set_active('profile.notifications') }}"
                    href="{{ route('profile.notifications') }}">
                    <i class="fi-bell me-2 opacity-60"></i>{{ __('Notifications') }}
                </a>
                <a class="card-nav-link" href="mailto:{{ setting('site_admin_email') }}">
                    <i class="fi-help me-2 opacity-60"></i>{{ __('Help') }}
                </a>
                <a class="card-nav-link" href="javascript:;" onclick="logout()">
                    <i class="fi-logout me-2 opacity-60"></i>{{ __('Sign Out') }}
                </a>
            </div>
        </div>
    </div>
</aside>
