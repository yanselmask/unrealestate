 <aside class="col-lg-4 col-md-5 ms-lg-auto pb-1">
     <!-- Contact card-->
     <div class="card mb-4 shadow-sm">
         <div class="card-body">
             <div class="d-flex align-items-start justify-content-between"><a class="text-decoration-none"
                     href="{{ route('agent.listing', $property->user) }}">
                     <img class="rounded-circle mb-2" src="{{ $property->user->profile_photo_url }}" width="60"
                         alt="{{ $property->user->fullname }}">
                     <h5 class="mb-1">{{ $property->user->fullname }}</h5>
                     <div class="mb-1">
                         <span class="star-rating">
                             @for ($i = 1; $i <= Number::forHumans($property->user->reviewsAvg); $i++)
                                 <i class="star-rating-icon fi-star-filled active"></i>
                             @endfor
                             @for ($i = Number::forHumans($property->user->reviewsAvg) + 1; $i <= 5; $i++)
                                 <i class="star-rating-icon fi-star-filled"></i>
                             @endfor
                         </span>
                         <span
                             class="fs-sm text-muted ms-1">({{ __(':count reviews', ['count' => $property->user->receivedReviews->count()]) }})</span>
                     </div>
                     <p class="text-body">{{ $property->user->about }}</p>
                 </a>
                 @if ($property->user->socials)
                     <div class="ms-4 flex-shrink-0">
                         @foreach ($property->user->socials as $social => $link)
                             <a class="btn btn-icon btn-light-primary btn-xs rounded-circle mb-2 ms-2 shadow-sm"
                                 href="{{ $link }}"><i class="fi-{{ $social }}"></i>
                             </a>
                         @endforeach
                     </div>
                 @endif
             </div>
             <ul class="list-unstyled border-bottom mb-4 pb-4">
                 @if ($property->user->phone)
                     <li>
                         <a class="nav-link fw-normal p-0" href="tel:{{ $property->user->phone }}">
                             <i class="fi-phone mt-n1 me-2 align-middle opacity-60"></i>{{ $property->user->phone }}
                         </a>
                     </li>
                 @endif
                 <li>
                     <a class="nav-link fw-normal p-0" href="mailto:{{ $property->user->email }}">
                         <i class="fi-mail mt-n1 me-2 align-middle opacity-60"></i>{{ $property->user->email }}
                     </a>
                 </li>
             </ul>
             @auth
                 <!-- Contact form-->
                 <form action="{{ route('listing.message') }}" method="POST">
                     @csrf
                     <input type="hidden" name="receiver_id" value="{{ $property->user->id }}">
                     <div class="input-group mb-3">
                         <input name="date" class="form-control" type="datetime-local"
                             placeholder="{{ __('Choose date') }}"
                             data-datepicker-options="{&quot;altInput&quot;: true, &quot;altFormat&quot;: &quot;F j, Y&quot;, &quot;dateFormat&quot;: &quot;Y-m-d&quot;}">
                     </div>
                     <textarea name="message" class="form-control @error('message') is-invalid @enderror mb-3" rows="3"
                         placeholder="{{ __('Message') }}" style="resize: none;"></textarea>
                     @error('message')
                         <div class="invalid-feedback">{{ $message }}</div>
                     @enderror
                     <button class="btn btn-lg btn-primary d-block w-100" type="submit">{{ __('Send request') }}</button>
                 </form>
             @endauth
         </div>
     </div>
     <!-- Location (Map)-->
     <div class="pt-2">
         <div class="position-relative mb-2">
             <img class="rounded-3" src="https://finder.createx.studio/img/real-estate/single/map.jpg"
                 alt="{{ __('Map') }}">
             <div class="d-flex w-100 h-100 align-items-center justify-content-center position-absolute start-0 top-0">
                 <a class="btn btn-primary stretched-link"
                     href="https://www.google.com/maps/embed/v1/place?key={{ env('GOOGLE_MAPS_API_KEY', '') }}&q={{ $property->address }}"
                     data-iframe="true" data-bs-toggle="lightbox">
                     <i class="fi-route me-2"></i>{{ __('Get directions') }}</a>
             </div>
         </div>
         <p class="fs-sm mb-0 text-center">{{ $property->address }}</p>
     </div>
 </aside>
