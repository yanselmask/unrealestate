 <button class="btn-like like-reviews-btn @auth @if ($review->liked()) text-success @endif @endauth"
     type="button" data-model="{{ $review->id }}">
     <i class="fi-like"></i><span id="counter_likes">{{ $review->likeCount }}</span>
 </button>
