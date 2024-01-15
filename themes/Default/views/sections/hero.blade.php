@php
    $categories = App\Models\Category::PropertyType()->get();
@endphp
<section class="pb-lg-4 container my-5 pt-5">
    <div class="row pt-md-2 pt-lg-0 pt-0">
        <div class="col-xl-7 col-lg-6 col-md-5 order-md-2 mb-lg-3 mb-4">
            <img src="{{ Storage::url($content[0]['data']['image']) }}" alt="{!! $content[0]['data']['heading'] !!}" />
        </div>
        <div class="col-xl-5 col-lg-6 col-md-7 order-md-1 pt-xl-5 pe-lg-0 text-md-start mb-3 text-center">
            <h1 class="display-4 mt-lg-5 mb-md-4 pt-md-4 pb-lg-2 mb-3">
                {!! $content[0]['data']['heading'] !!}
            </h1>
            <p class="position-relative lead me-lg-n5">
                {!! $content[0]['data']['description'] !!}
            </p>
        </div>
        <!-- Search property form group-->
        <div class="col-xl-8 col-lg-10 mt-lg-n5 order-3">
            <form class="form-group d-block" action="{{ route('home.listing.search') }}">
                <div class="row g-0 ms-sm-n2">
                    <div class="col-md-8 d-sm-flex align-items-center">
                        <div class="dropdown w-sm-50 border-end-sm" data-bs-toggle="select">
                            <button class="btn btn-link dropdown-toggle ps-sm-3 ps-2" type="button"
                                data-bs-toggle="dropdown">
                                <i class="fi-home me-2"></i>
                                <span class="dropdown-toggle-label">{{ __('For') }}</span>
                            </button>
                            <ul class="dropdown-menu ps-2">
                                <li>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" id="forrent" type="radio" name="for"
                                            value="rent">
                                        <label class="form-check-label" for="forrent">{{ __('For Rent') }}</label>
                                    </div>
                                </li>
                                <li>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" id="forsale" type="radio" name="for"
                                            value="sale">
                                        <label class="form-check-label" for="forsale">{{ __('For Sale') }}</label>
                                    </div>
                                </li>
                            </ul>
                        </div>
                        <hr class="d-sm-none my-2" />
                        <div class="dropdown w-sm-50 border-end-sm" data-bs-toggle="select">
                            <button class="btn btn-link dropdown-toggle ps-sm-3 ps-2" type="button"
                                data-bs-toggle="dropdown">
                                <i class="fi-map-pin me-2"></i><span
                                    class="dropdown-toggle-label">{{ __('Location') }}</span>
                            </button>
                            <ul class="dropdown-menu">
                                <li>
                                    <input name="city" id="address_box" type="text" class="form-control">
                                </li>
                            </ul>
                        </div>
                        <hr class="d-sm-none my-2" />
                        <div class="dropdown w-sm-50 border-end-md" data-bs-toggle="select">
                            <button class="btn btn-link dropdown-toggle ps-sm-3 ps-2" type="button"
                                data-bs-toggle="dropdown">
                                <i class="fi-list me-2"></i>
                                <span class="dropdown-toggle-label">{{ __('Property type') }}</span>
                            </button>
                            <ul class="dropdown-menu ps-2">
                                @foreach ($categories as $category)
                                    <div class="form-check">
                                        <input name="property_type[]" class="form-check-input" type="checkbox"
                                            id="type-{{ $category->id }}" value="{{ $category->id }}">
                                        <label class="form-check-label fs-sm"
                                            for="type-{{ $category->id }}">{{ $category->title }}</label>
                                    </div>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                    <hr class="d-md-none mt-2" />
                    <div class="col-md-4 d-sm-flex align-items-center pt-md-0 pt-4">
                        <div class="d-flex align-items-center w-100 py-sm-0 ps-sm-3 pb-4 ps-2 pt-2">
                            <i class="fi-cash fs-lg text-muted me-2"></i>
                            <span class="text-muted">{{ __('Price') }}</span>
                            <div class="range-slider pe-sm-3 pe-0" data-start-min="450" data-min="0" data-max="1000"
                                data-step="1">
                                <div class="range-slider-ui"></div>
                                <input name="price" class="form-control range-slider-value-min" type="hidden" />
                            </div>
                        </div>
                        <button class="btn btn-icon btn-primary w-100 w-sm-auto flex-shrink-0 px-3" type="submit">
                            <i class="fi-search"></i><span
                                class="d-sm-none d-inline-block ms-2">{{ __('Search') }}</span>
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</section>
