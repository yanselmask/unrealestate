<section class="container mb-5 pb-1">
    <div class="row">
        <div class="col-md-7 mb-md-0 mb-4">
            @if ($property->verified)
                <span class="badge bg-success mb-3 me-2">{{ __('Verified') }}</span>
            @endif
            @if (is_new($property->created_at))
                <span class="badge bg-info mb-3 me-2">{{ __('New') }}</span>
            @endif
            @if ($property->featured)
                <span class="badge bg-primary mb-3 me-2">{{ __('Featured') }}</span>
            @endif
            <h2 class="h3 border-bottom mb-4 pb-4">
                {{ $property->price }}
                @if ($property->property_type == 1)
                    <span class="d-inline-block fs-base fw-normal text-body">/{{ $property->rent_interval }}</span>
                @endif
            </h2>
            <!-- Overview-->
            @include('partials.listing.single.overview')
            <!-- Property Details-->
            @include('partials.listing.single.details')
            <!-- Amenities-->
            @include('partials.listing.single.amenities')
            <!-- Property Virtual -->
            @include('partials.listing.single.virtual')
            <!-- Property Video -->
            @include('partials.listing.single.video')
            <!-- Post meta-->
            @include('partials.listing.single.post_meta')
            <!-- Reviews Head-->
            @include('partials.listing.single.reviews_head')
            <!-- Reviews-->
            @each('partials.listing.single.reviews', $reviews, 'review', 'partials.not_found')
            <!-- Pagination-->
            {{ $reviews->appends(request()->query())->links() }}
        </div>
        <!-- Sidebar-->
        @include('partials.listing.single.sidebar')
    </div>
</section>
