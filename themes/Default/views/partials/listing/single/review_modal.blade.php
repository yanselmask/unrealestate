 <div class="modal fade" id="modal-review" tabindex="-1">
     <div class="modal-dialog modal-dialog-centered" role="document">
         <div class="modal-content">
             <div class="modal-header d-block position-relative px-sm-5 border-0 px-4 pb-0">
                 <h3 class="modal-title mt-4 text-center">{{ __('Leave a review') }}</h3>
                 <button class="btn-close position-absolute end-0 top-0 me-3 mt-3" type="button" data-bs-dismiss="modal"
                     aria-label="Close"></button>
             </div>
             <div class="modal-body px-sm-5 px-4">
                 <form action="{{ route('listing.review.store', $property) }}" method="POST">
                     @csrf
                     <div class="mb-3">
                         <label class="form-label" for="review-rating">{{ __('Rating') }} <span
                                 class='text-danger'>*</span></label>
                         <select name="stars" class="form-control @error('stars') is-invalid @enderror form-select"
                             id="review-rating" required>
                             <option value="" selected disabled hidden>{{ __('Choose rating') }}</option>
                             <option value="5">{{ __('5 stars') }}</option>
                             <option value="4">{{ __('4 stars') }}</option>
                             <option value="3">{{ __('3 stars') }}</option>
                             <option value="2">{{ __('2 stars') }}</option>
                             <option value="1">{{ __('1 star') }}</option>
                         </select>
                         @error('stars')
                             <div class="invalid-feedback">{{ $message }}</div>
                         @enderror
                     </div>
                     <div class="mb-4">
                         <label class="form-label" for="review-text">{{ __('Review') }} <span
                                 class='text-danger'>*</span></label>
                         <textarea name="message" class="form-control" id="review-text" rows="5"
                             placeholder="{{ __('Your review message') }}" required></textarea>
                         @error('message')
                             <div class="invalid-feedback">{{ $message }}</div>
                         @enderror
                     </div>
                     <button class="btn btn-primary d-block w-100 mb-4"
                         type="submit">{{ __('Submit a review') }}</button>
                 </form>
             </div>
         </div>
     </div>
 </div>
