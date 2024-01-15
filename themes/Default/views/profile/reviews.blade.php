@extends('profile.layout', [
    'before' => [
        'Home' => route('home'),
        'Account' => route('profile.edit'),
    ],
    'active' => __('Reviews'),
])
@section('content')
    <h1 class="h2">{{ __('Reviews') }}</h1>
    <p class="mb-4 pt-1">{{ __('Reviews you’ve received will be visible both here and on your public profile') }}.</p>
    <!-- Nav tabs-->
    <ul class="nav nav-tabs flex-column flex-sm-row align-items-stretch align-items-sm-start border-bottom mb-4"
        role="tablist">
        <li class="nav-item me-sm-3 mb-3">
            <a class="nav-link @if (!request()->query('reviews_by_me')) active @endif text-center" href="#reviews-about-you"
                data-bs-toggle="tab" role="tab" aria-controls="reviews-about-you"
                aria-selected="@if (!request()->query('reviews_by_me')) true @endif">{{ __('Reviews about you') }}
            </a>
        </li>
        <li class="nav-item mb-3">
            <a class="nav-link @if (request()->query('reviews_by_me')) active @endif text-center" href="#reviews-by-you"
                data-bs-toggle="tab" role="tab" aria-controls="reviews-by-you"
                aria-selected="@if (request()->query('reviews_by_me')) true @endif">{{ __('Reviews by you') }}
            </a>
        </li>
    </ul>
    <!-- Tabs content-->
    <div class="tab-content pt-2">
        <!-- Reviews about you tab-->
        <div class="tab-pane fade @if (!request()->query('reviews_by_me')) show active @endif" id="reviews-about-you"
            role="tabpanel">
            <div
                class="d-flex flex-sm-row flex-column align-items-sm-center align-items-stretch justify-content-between mb-md-3 mb-2 pb-4">
                <h3 class="h4 mb-sm-0">
                    <i
                        class="fi-star-filled mt-n1 lead text-warning me-2 align-middle"></i>{{ __(':average (:count reviews)', ['average' => $average, 'count' => $reviewsAboutMe->total()]) }}
                </h3>
            </div>
            <!-- Reviews-->
            @each('partials.listing.single.reviews', $reviewsAboutMe, 'review')
            <!-- Pagination-->
            {{ $reviewsAboutMe->appends(request()->query())->links() }}
        </div>
        <!-- Reviews by you tab-->
        <div class="tab-pane fade @if (request()->query('reviews_by_me')) show active @endif" id="reviews-by-you" role="tabpanel">
            <div
                class="d-flex flex-sm-row flex-column align-items-sm-center align-items-stretch justify-content-between mb-md-3 mb-2 pb-4">
                <h3 class="h4 mb-sm-0">{{ __(':count reviews', ['count' => $reviewsByMe->total()]) }}</h3>
            </div>
            <!-- Review-->
            @each('partials.listing.single.reviews', $reviewsByMe, 'review')
            <!-- Pagination -->
            {{ $reviewsByMe->appends(request()->query())->links() }}
        </div>
    </div>
@endsection
