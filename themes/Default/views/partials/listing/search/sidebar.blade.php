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
                      <h3 class="h6">
                          {{ __(request()->query('for') == 'sale' ? 'Price per month' : 'Property price') }}</h3>
                      <!-- Range slider: Two handles + inputs -->
                      <div class="range-slider" data-start-min="{{ request()->query('min_price', min_price()) }}"
                          data-min="{{ min_price() }}"
                          data-start-max="{{ request()->query('max_price', max_price()) }}"
                          data-max="{{ max_price() }}" data-step="1" />
                      <div class="range-slider-ui"></div>
                      <div class="d-flex align-items-center">
                          <div class="w-50 pe-2">
                              <div class="input-group"><span
                                      class="input-group-text fs-base">{{ site_currency(currency()->getUserCurrency(), 'symbol') }}</span>
                                  <input class="form-control range-slider-value-min currency" type="text"
                                      name="min_price" value="{{ request()->query('min_price') }}">
                              </div>
                          </div>
                          <div class="text-muted">&mdash;</div>
                          <div class="w-50 ps-2">
                              <div class="input-group"><span
                                      class="input-group-text fs-base">{{ site_currency(currency()->getUserCurrency(), 'symbol') }}</span>
                                  <input class="form-control range-slider-value-max currency" type="text"
                                      name="max_price" value="{{ request()->query('max_price') }}">
                              </div>
                          </div>
                      </div>
                  </div>
                  <div class="mb-2 mt-3 pb-4">
                      <h3 class="h6 pt-1">{{ __('Amenities') }}</h3>
                      @foreach ($facilities->whereIn('type', ['radio', 'select']) as $facility)
                          <label class="d-block fs-sm mb-1">{{ $facility->name }}</label>
                          <div class="btn-group btn-group-sm mb-3" role="group">
                              @foreach ($facility->values as $value)
                                  @php
                                      $facilityId = $facility->id;
                                      $facilityValue = request()->query('facility')[$facilityId] ?? null;

                                      $isChecked = request()->query('facility') && array_key_exists($facilityId, request()->query('facility')) && str_contains($value['value'], $facilityValue);
                                  @endphp
                                  <input class="btn-check" type="radio"
                                      id="facility-{{ $facility->id }}-value-{{ $loop->index }}"
                                      @checked($isChecked) name="facility[{{ $facility->id }}]"
                                      value="{{ $value['value'] }}">
                                  <label class="btn btn-outline-secondary fw-normal"
                                      for="facility-{{ $facility->id }}-value-{{ $loop->index }}">{{ $value['value'] }}</label>
                              @endforeach
                          </div>
                      @endforeach
                      @foreach ($facilities->whereIn('type', ['textbox', 'number', 'textarea', 'markdown']) as $facility)
                          <div class="mb-2">
                              <label class="d-block fs-sm mb-1">{{ $facility->name }}</label>
                              @php
                                  $facilityId = $facility->id;
                                  $termsValue = request()->query('terms')[$facilityId] ?? '';
                              @endphp
                              <input type="text" class="form-control" name="terms[{{ $facilityId }}]"
                                  placeholder="{{ __('Enter value') }}" value="{{ $termsValue }}">
                          </div>
                      @endforeach
                      @foreach ($facilities->where('type', 'checkbox') as $facility)
                          <div class="simplebar-content" style="padding: 0px;">
                              <label class="d-block fs-sm mb-1"><b>{{ $facility->name }}</b></label>
                              @foreach ($facility->values as $value)
                                  @php
                                      $facilityId = $facility->id;
                                      $checks = request()->query('checks') ?? [];
                                      $facilityValue = $checks[$facilityId] ?? null;

                                      $isChecked = request()->query('checks') && array_key_exists($facilityId, request()->query('checks')) && in_array($value['value'], $facilityValue);
                                  @endphp
                                  <div class="form-check">
                                      <input class="form-check-input" type="checkbox"
                                          name="checks[{{ $facility->id }}][]"
                                          id="facility-{{ $facility->id }}-value-{{ $loop->index }}"
                                          @checked($isChecked) value="{{ $value['value'] }}">
                                      <label class="form-check-label fs-sm"
                                          for="facility-{{ $facility->id }}-value-{{ $loop->index }}">{{ $value['value'] }}</label>
                                  </div>
                              @endforeach
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
                      <input class="form-check-input" id="yesterday" type="radio" name="posted"
                          value="yesterday" @checked(request()->query('posted') == 'yesterday')>
                      <label class="form-check-label" for="yesterday">{{ __('Yesterday') }}</label>
                  </div>
              </div>
              <div class="mb-2 pb-4">
                  <h3 class="h6">{{ __('Additional options') }}</h3>
                  <div class="form-check">
                      <input @checked(in_array('verified', request()->query('options', []))) class="form-check-input" type="checkbox" id="verified"
                          name="options[]" value="verified">
                      <label class="form-check-label fs-sm" for="verified">{{ __('Verified') }}</label>
                  </div>
                  <div class="form-check">
                      <input @checked(in_array('featured', request()->query('options', []))) class="form-check-input" type="checkbox" id="featured"
                          name="options[]" value="featured">
                      <label class="form-check-label fs-sm" for="featured">{{ __('Featured') }}</label>
                  </div>
                  <div class="form-check">
                      <input @checked(in_array('new', request()->query('options', []))) class="form-check-input" type="checkbox" id="new"
                          name="options[]" value="new">
                      <label class="form-check-label fs-sm" for="new">{{ __('New') }}</label>
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

  @push('js_vendor')
      <script>
          let currencies = document.querySelectorAll('.currency');
          currencies.forEach((input) => {
              let cleave = new Cleave(input, {
                  numeral: true,
                  numeralThousandsGroupStyle: 'thousand'
              });
          })
      </script>
  @endpush
