  <section class="container mt-5 pt-5">
      <!-- Breadcrumb-->
      @include('partials.breadcrumb', [
          'before' => [
              'Home' => route('home'),
              $property->property_type == 0 ? 'Property for sale' : 'Property for rent' =>
                  $property->property_type == 0
                      ? route('home.listing.search', ['for' => 'sale'])
                      : route('home.listing.search', ['for' => 'rent']),
          ],
          'active' => $property->title,
      ])
      <h1 class="h2 mb-2">{{ $property->title }}</h1>
      <p class="fs-lg mb-2 pb-1">{{ $property->address }}</p>
      <!-- Features + Sharing-->
      <div class="d-flex justify-content-between align-items-center">
          @if ($property->facilities)
              <ul class="d-flex list-unstyled mb-4">
                  @foreach ($property->facilities()->whereIn('type', ['radio', 'textbox'])->get()->slice(0, 5) as $item)
                      <li class="@if (!$loop->last) border-end @endif me-3 pe-3">
                          <b class="me-1">{{ facility_value($property->id, $item->id) }}</b> {!! $item->icon ?? null !!}
                      </li>
                  @endforeach
              </ul>
          @endif
          <div class="text-nowrap">
              @include('partials.btn_wishlist')
              <div class="dropdown d-inline-block" data-bs-toggle="tooltip" title="Share">
                  <button class="btn btn-icon btn-light-primary btn-xs rounded-circle mb-2 ms-2 shadow-sm"
                      type="button" data-bs-toggle="dropdown">
                      <i class="fi-share"></i>
                  </button>
                  <div class="dropdown-menu dropdown-menu-end my-1">
                      <a class="dropdown-item" target="_blank"
                          href="https://www.facebook.com/sharer/sharer.php?u={{ request()->url() }}">
                          <i class="fi-facebook fs-base me-2 opacity-75"></i>{{ __('Facebook') }}
                      </a>
                      <a class="dropdown-item" target="_blank"
                          href="https://twitter.com/intent/tweet?url={{ request()->url() }}&text={{ $property->title }}">
                          <i class="fi-twitter fs-base me-2 opacity-75"></i>{{ __('Twitter') }}
                      </a>
                      <a class="dropdown-item" target="_blank" href="https://instagram.com">
                          <i class="fi-instagram fs-base me-2 opacity-75"></i>{{ __('Instagram') }}
                      </a>
                  </div>
              </div>
          </div>
      </div>
  </section>
