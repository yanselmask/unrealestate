@php
    $menu = RyanChandler\FilamentNavigation\Models\Navigation::fromHandle('main-menu ');
    $user = auth()->user() ?? null;
@endphp
<header class="navbar navbar-expand-lg navbar-light bg-light fixed-top" data-scroll-header>
    <div class="container">
        <a class="navbar-brand me-xl-4 me-3" href="{{ route('home') }}">
            <img class="d-block" src="{{ site_logo() }}" width="116" alt="{{ setting('site_name') }}" />
        </a>
        <button class="navbar-toggler ms-auto" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <li class="nav-item dropdown d-lg-block order-lg-3 my-n2 me-3">
            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                aria-expanded="false">{{ currency()->getUserCurrency() }}</a>
            <ul class="dropdown-menu">
                @foreach (currency()->getCurrencies() as $currency)
                    <li>
                        <a class="dropdown-item @if (currency()->getUserCurrency() == $currency['code']) active @endif"
                            href="{{ route('currency.change', $currency['code']) }}">{{ $currency['name'] . ' - ' . $currency['code'] }}</a>
                    </li>
                @endforeach
            </ul>
        </li>
        @guest
            <a class="btn btn-sm text-primary d-none d-lg-block order-lg-3" href="{{ route('login') }}">
                <i class="fi-user me-2"></i>{{ __('Sign in') }}
            </a>
        @else
            <div class="dropdown d-none d-lg-block order-lg-3 my-n2 me-3">
                <a class="d-block py-2" href="{{ route('profile.edit') }}">
                    <img class="rounded-circle" style="width:40px;height:40px;object-fit: cover;"
                        src="{{ $user->profile_photo_url }}" alt="{{ $user->fullname }}">
                </a>
                <div class="dropdown-menu dropdown-menu-end">
                    <div class="d-flex align-items-start border-bottom mb-2 px-3 py-1" style="width: 16rem;">
                        <img class="rounded-circle" src="{{ $user->profile_photo_url }}"
                            style="width:48px;height:48px;object-fit: cover;" alt="{{ $user->fullname }}">
                        <div class="ps-2">
                            <h6 class="fs-base mb-0">{{ $user->fullname }}</h6>
                            <span class="star-rating star-rating-sm">
                                @for ($i = 1; $i <= Number::forHumans($user->reviewsAvg); $i++)
                                    <i class="star-rating-icon fi-star-filled active"></i>
                                @endfor
                                @for ($i = Number::forHumans($user->reviewsAvg) + 1; $i <= 5; $i++)
                                    <i class="star-rating-icon fi-star-filled"></i>
                                @endfor
                            </span>
                            <div class="fs-xs py-2">{{ $user->phone }}<br>{{ $user->email }}</div>
                        </div>
                    </div>
                    <a class="dropdown-item" href="{{ route('profile.edit') }}">
                        <i class="fi-user me-2 opacity-60"></i>{{ __('Personal Info') }}
                    </a>
                    <a class="dropdown-item" href="{{ route('profile.password') }}">
                        <i class="fi-lock me-2 opacity-60"></i>{{ __('Password & Security') }}
                    </a>
                    <a class="dropdown-item" href="{{ route('profile.listing') }}?status=published">
                        <i class="fi-home me-2 opacity-60"></i>{{ __('My Properties') }}
                    </a>
                    <a class="dropdown-item" href="{{ route('profile.wishlist') }}">
                        <i class="fi-heart me-2 opacity-60"></i>{{ __('Wishlist') }}
                    </a>
                    <a class="dropdown-item" href="{{ route('profile.reviews') }}">
                        <i class="fi-star me-2 opacity-60"></i>{{ __('Reviews') }}
                    </a>
                    <a class="dropdown-item" href="{{ route('profile.notifications') }}">
                        <i class="fi-bell me-2 opacity-60"></i>{{ __('Notifications') }}
                    </a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="mailto:{{ setting('site_admin_email') }}">{{ __('Help') }}</a>
                    <a class="dropdown-item" href="javascript:;" onclick="logout()">{{ __('Sign Out') }}</a>
                </div>
            </div>
            @if ($user->propertiesRestants > 0)
                <a class="btn btn-primary btn-sm order-lg-3 ms-2" href="{{ route('home.listing.add') }}">
                    <i class="fi-plus me-2"></i>{{ __('Add') }}&nbsp;
                    <span class="d-none d-sm-inline">{{ __('property') }}</span>
                </a>
            @endif
        @endguest
        <div class="navbar-collapse order-lg-2 collapse" id="navbarNav">
            <ul class="navbar-nav navbar-nav-scroll" style="max-height: 35rem">
                @include('partials.menu')
                @guest
                    <li class="nav-item d-lg-none">
                        <a class="nav-link" href="{{ route('login') }}">
                            <i class="fi-user me-2"></i>{{ __('Sign in') }}
                        </a>
                    </li>
                @else
                    <li class="nav-item dropdown d-lg-none">
                        <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            <img class="rounded-circle me-2" src="{{ $user->profile_photo_url }}"
                                style="width:40px;height:40px;object-fit: cover;"
                                alt="{{ $user->fullname }}">{{ $user->fullname }}
                        </a>
                        <div class="dropdown-menu">
                            <div class="ps-3">
                                <span class="star-rating star-rating-sm">
                                    @for ($i = 1; $i <= Number::forHumans($user->reviewsAvg); $i++)
                                        <i class="star-rating-icon fi-star-filled active"></i>
                                    @endfor
                                    @for ($i = Number::forHumans($user->reviewsAvg) + 1; $i <= 5; $i++)
                                        <i class="star-rating-icon fi-star-filled"></i>
                                    @endfor
                                </span>
                                <div class="fs-xs py-2">{{ $user->phone }}<br>{{ $user->email }}</div>
                            </div>
                            <a class="dropdown-item" href="{{ route('profile.edit') }}">
                                <i class="fi-user me-2 opacity-60"></i>{{ __('Personal Info') }}
                            </a>
                            <a class="dropdown-item" href="{{ route('profile.password') }}">
                                <i class="fi-lock me-2 opacity-60"></i>{{ __('Password & Security') }}
                            </a>
                            <a class="dropdown-item" href="{{ route('profile.listing') }}">
                                <i class="fi-home me-2 opacity-60"></i>{{ __('My Properties') }}
                            </a>
                            <a class="dropdown-item" href="{{ route('profile.wishlist') }}">
                                <i class="fi-heart me-2 opacity-60"></i>{{ __('Wishlist') }}
                            </a>
                            <a class="dropdown-item" href="{{ route('profile.reviews') }}">
                                <i class="fi-star me-2 opacity-60"></i>{{ __('Reviews') }}
                            </a>
                            <a class="dropdown-item" href="{{ route('profile.notifications') }}">
                                <i class="fi-bell me-2 opacity-60"></i>{{ __('Notifications') }}
                            </a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item"
                                href="mailto:{{ setting('site_admin_email') }}">{{ __('Help') }}</a>
                            <a class="dropdown-item" href="javascript:;" onclick="logout()">{{ __('Sign Out') }}</a>
                        </div>
                    </li>
                @endguest
            </ul>
        </div>
    </div>
</header>
