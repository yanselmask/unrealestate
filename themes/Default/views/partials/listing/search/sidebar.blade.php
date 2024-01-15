  <aside class="col-lg-4 col-xl-3 border-top-lg border-end-lg px-xl-4 px-xxl-5 pt-lg-2 px-3 shadow-sm">
      <form>
          <div class="offcanvas-lg offcanvas-start" id="filters-sidebar">
              <div class="offcanvas-header d-flex d-lg-none align-items-center">
                  <h2 class="h5 mb-0">{{ __('Filters') }}</h2>
                  <button class="btn-close" type="button" data-bs-dismiss="offcanvas"
                      data-bs-target="#filters-sidebar"></button>
              </div>
              <div class="offcanvas-header d-block border-bottom pt-lg-4 px-lg-0 pt-0">
                  <input id="for_box" type="hidden" name="for" value="{{ request()->query('for', '') }}" />
                  <input type="hidden" name="sort_by" value="{{ request()->query('sort_by', '') }}" />
                  <ul class="nav nav-tabs mb-0">
                      <li class="nav-item">
                          <a onclick="toggleFor(this,'rent')"
                              class="nav-link {{ request()->query('for', '') == 'rent' ? 'active' : '' }}">
                              <i class="fi-rent fs-base me-2"></i>
                              {{ __('For rent') }}
                          </a>
                      </li>
                      <li class="nav-item">
                          <a onclick="toggleFor(this,'sale')"
                              class="nav-link {{ request()->query('for', '') == 'sale' ? 'active' : '' }}">
                              <i class="fi-home fs-base me-2"></i>
                              {{ __('For sale') }}
                          </a>
                      </li>
                  </ul>
              </div>
              <div class="offcanvas-body py-lg-4">
                  <div class="mb-2 pb-4">
                      <h3 class="h6">{{ __('Location') }}</h3>
                      <input value="{{ request()->query('city', '') }}" name="city" class="form-control mb-2"
                          type="text" id="address_box" placeholder="{{ __('Enter an city') }}">
                  </div>
                  <div class="mb-2 pb-4">
                      <h3 class="h6">{{ __('Property type') }}</h3>
                      <div class="overflow-auto" data-simplebar data-simplebar-auto-hide="false" style="height: 11rem;">
                          @foreach ($types as $type)
                              <div class="form-check">
                                  <input name="property_type[]" @checked(in_array($type->id, request()->query('property_type', []))) class="form-check-input"
                                      type="checkbox" id="type-{{ $type->id }}" value="{{ $type->id }}">
                                  <label class="form-check-label fs-sm"
                                      for="type-{{ $type->id }}">{{ $type->title }}</label>
                              </div>
                          @endforeach
                      </div>
                  </div>
                  <div class="mb-2 pb-4">
                      <h3 class="h6">{{ __('Posted Since') }}</h3>
                      <!-- Inline radios -->
                      <div class="form-check form-check-inline">
                          <input class="form-check-input" id="anytime" type="radio" name="posted" value="anytime"
                              @checked(request()->query('posted') == 'anytime')>
                          <label class="form-check-label" for="anytime">{{ __('Anytime') }}</label>
                      </div>
                      <div class="form-check form-check-inline">
                          <input class="form-check-input" id="lastweek" type="radio" value="lastweek" name="posted"
                              @checked(request()->query('posted') == 'lastweek')>
                          <label class="form-check-label" for="lastweek">{{ __('Last Week') }}</label>
                      </div>
                      <div class="form-check form-check-inline">
                          <input class="form-check-input" id="yesterday" type="radio" name="posted" value="yesterday"
                              @checked(request()->query('posted') == 'yesterday')>
                          <label class="form-check-label" for="yesterday">{{ __('Yesterday') }}</label>
                      </div>
                  </div>
                  <div class="mb-2 pb-4">
                      <h3 class="h6">{{ __('Additional options') }}</h3>
                      <div class="form-check">
                          <input @checked(request()->query('verified', '')) class="form-check-input" type="checkbox" id="verified"
                              name="verified" value="true">
                          <label class="form-check-label fs-sm" for="verified">{{ __('Verified') }}</label>
                      </div>
                      <div class="form-check">
                          <input @checked(request()->query('featured', '')) class="form-check-input" type="checkbox" id="featured"
                              name="featured" value="true">
                          <label class="form-check-label fs-sm" for="featured">{{ __('Featured') }}</label>
                      </div>
                  </div>
                  <div class="border-top py-4">
                      <button class="btn btn-outline-primary" type="submit">
                          <i class="fi-rotate-right me-2"></i>{{ __('Update search') }}
                      </button>
                  </div>
              </div>
          </div>
      </form>
  </aside>
