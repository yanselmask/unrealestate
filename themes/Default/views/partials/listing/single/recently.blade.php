  @if ($recents->count() > 0)
      <section class="pb-lg-4 container mb-5 pb-2">
          <div class="d-flex align-items-center justify-content-between mb-3">
              <h2 class="h3 mb-0">{{ __('Recently viewed') }}</h2>
              <a class="btn btn-link fw-normal p-0" href="{{ route('home.listing.search') }}">{{ __('View all') }}
                  <i class="fi-arrow-long-right ms-2"></i>
              </a>
          </div>
          <div class="tns-carousel-wrapper tns-controls-outside-xxl tns-nav-outside tns-nav-outside-flush mx-n2">
              <div class="tns-carousel-inner row gx-4 mx-0 pb-4 pt-3"
                  data-carousel-options="{&quot;items&quot;: 4, &quot;responsive&quot;: {&quot;0&quot;:{&quot;items&quot;:1},&quot;500&quot;:{&quot;items&quot;:2},&quot;768&quot;:{&quot;items&quot;:3},&quot;992&quot;:{&quot;items&quot;:4}}}">
                  <!-- Item-->
                  @each('partials.listing.search.grid', $recents, 'property', 'partials.not_found')
              </div>
          </div>
      </section>
  @endif
