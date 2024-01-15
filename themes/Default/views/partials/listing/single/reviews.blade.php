<div class="border-bottom mb-4 pb-4">
    <div class="d-flex justify-content-between mb-3">
        <div class="d-flex align-items-center pe-2">
            <img class="rounded-circle me-1" src="{{ $review->user->profile_photo_url }}" width="48"
                alt="{{ $review->user->fullname }}">
            <div class="ps-2">
                <h6 class="fs-base mb-0">{{ $review->user->fullname }}</h6><span class="star-rating">
                    @for ($i = 1; $i <= $review->stars; $i++)
                        <i class="star-rating-icon fi-star-filled active"></i>
                    @endfor
                    @for ($i = $review->stars + 1; $i <= 5; $i++)
                        <i class="star-rating-icon fi-star-filled"></i>
                    @endfor
                </span>
            </div>
        </div><span class="text-muted fs-sm">{{ site_date($review->created_at) }}</span>
    </div>
    <p>{{ $review->message }}</p>
    <div class="d-flex align-items-center">
        @include('partials.like_btn')
    </div>
</div>
