     <div class="card card-hover card-horizontal mb-4 border-0 shadow-sm">
         <div class="card-img-top position-relative"
             style="background-image: url({{ $property->getFirstMediaUrl('gallery', 'thumb') }});">
             <a class="stretched-link" href="{{ route('home.listing.show', $property) }}">
             </a>
             <div class="position-absolute start-0 top-0 ps-3 pt-3">
                 @if ($property->verified)
                     <span class="d-table badge bg-success mb-1">{{ __('Verified') }}</span>
                 @endif
                 @if (is_new($property->created_at))
                     <span class="d-table badge bg-info mb-1">{{ __('New') }}</span>
                 @endif
                 @if ($property->featured)
                     <span class="d-table badge bg-primary">{{ __('Featured') }}</span>
                 @endif
             </div>
             <div class="position-absolute zindex-5 end-0 top-0 pe-3 pt-3">
                 @include('partials.btn_wishlist')
             </div>
         </div>
         <div class="card-body position-relative pb-3">
             <h4 class="fs-xs fw-normal text-uppercase text-primary mb-1">
                 {{ $property->property_type == 0 ? 'For Sell' : 'For Rent' }}</h4>
             <h3 class="h6 fs-base mb-2">
                 <a class="nav-link stretched-link"
                     href="{{ route('home.listing.show', $property) }}">{{ $property->title }}</a>
             </h3>
             <p class="fs-sm text-muted mb-2">{{ $property->address }}</p>
             <div class="fw-bold"><i
                     class="fi-cash mt-n1 lead me-2 align-middle opacity-70"></i>{{ currency_price($property->price[0]['price'], 'EUR') }}
             </div>
         </div>
     </div>
