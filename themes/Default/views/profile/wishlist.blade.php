@extends('profile.layout', [
    'before' => [
        'Home' => route('home'),
        'Account' => route('profile.edit'),
    ],
    'active' => __('Wishlist'),
])
@section('content')
    @include('partials.modal.confirm', [
        'route' => route('profile.wishlist.destroy.all'),
        'title' => 'Surely you want to clean your wish list',
        'id' => 'clearWishlistForm',
    ])
    <div class="d-flex align-items-center justify-content-between mb-4 pb-2">
        <h1 class="h2 mb-0">{{ __('Wishlist') }}</h1>
        @if ($properties->count() > 0)
            <a data-bs-toggle="modal" data-bs-target="#clearWishlistForm" class="fw-bold text-decoration-none"
                href="javascript:;">
                <i class="fi-x fs-xs mt-n1 me-2"></i>{{ __('Clear all') }}
            </a>
        @endif
    </div>
    <!-- Item-->
    @each('partials.listing.wishlist', $properties, 'property', 'partials.not_found')
@endsection
