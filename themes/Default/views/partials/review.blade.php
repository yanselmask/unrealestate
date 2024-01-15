 <div class="border-bottom mb-4 pb-4">
     <div class="d-flex justify-content-between mb-3">
         <div class="d-flex align-items-center pe-2">
             <img class="rounded-circle me-1" src="img/avatars/06.jpg" width="48" alt="{{ $review->user->fullanme }}">
             <div class="ps-2">
                 <h6 class="fs-base mb-0">{{ $review->user->fullname }}</h6>
                 <span class="star-rating">
                     <i class="star-rating-icon fi-star-filled active"></i>
                     <i class="star-rating-icon fi-star-filled active"></i>
                     <i class="star-rating-icon fi-star-filled active"></i>
                     <i class="star-rating-icon fi-star-filled active"></i>
                     <i class="star-rating-icon fi-star-filled active"></i>
                 </span>
             </div>
         </div><span class="text-muted fs-sm">{{ site_date($review->created_at) }}</span>
     </div>
     <p>{{ $review->message }}</p>
     <div class="d-flex align-items-center">
         <button class="btn-like" type="button">
             <i class="fi-like"></i><span>(3)</span>
         </button>
     </div>
 </div>
