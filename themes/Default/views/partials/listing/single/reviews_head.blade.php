 <div class="border-bottom mb-4 pb-4" id="reviews">
     <h3 class="h4 pb-3">
         <i class="fi-star-filled mt-n1 lead text-warning me-2 align-middle"></i>
         {{ __(':average (:count reviews)', ['average' => $average, 'count' => $property->reviews->count()]) }}
     </h3>
     <div class="d-flex flex-sm-row flex-column align-items-sm-center align-items-stretch justify-content-between">
         <a class="btn btn-outline-primary mb-sm-0 mb-3" href="#modal-review" data-bs-toggle="modal">
             <i class="fi-edit me-1"></i>
             {{ __('Add review') }}
         </a>
         <div class="d-flex align-items-center ms-sm-4">
             <label class="text-nowrap me-2 pe-1" for="reviews-sorting"><i
                     class="fi-arrows-sort text-muted mt-n1 me-2"></i>{{ __('Sort by:') }}</label>
             <select name="sort_by" class="form-select" id="reviews-sorting">
                 <option value="desc" @selected(request()->query('sort_by') == 'desc')>{{ __('Newest') }}</option>
                 <option value="asc" @selected(request()->query('sort_by') == 'asc')>{{ __('Oldest') }}</option>
                 <option value="popular" @selected(request()->query('sort_by') == 'popular')>{{ __('Popular') }}</option>
                 <option value="high" @selected(request()->query('sort_by') == 'high')>{{ __('High rating') }}</option>
                 <option value="low" @selected(request()->query('sort_by') == 'low')>{{ __('Low rating') }}</option>
             </select>
         </div>
     </div>
 </div>
