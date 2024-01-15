<x-master-layout>
    <div class="container-fluid mt-5 p-0 pt-5">
        <div class="row g-0 mt-n3">
            <!-- Filters sidebar (Offcanvas on mobile)-->
            @include('partials.listing.search.sidebar')
            <!-- Page content-->
            <div class="col-lg-8 col-xl-9 position-relative px-xl-4 px-xxl-5 overflow-hidden px-3 pb-5 pt-4">
                <!-- Breadcrumb-->
                @include('partials.breadcrumb', [
                    'before' => [
                        'Home' => route('home'),
                    ],
                    'active' => __('Property for :for', [
                        'for' =>
                            request()->query('for') == 'rent'
                                ? 'Rent'
                                : (request()->query('for') == 'sale'
                                    ? 'Sale'
                                    : 'Anything'),
                    ]),
                ])
                <!-- Title-->
                <div class="d-sm-flex align-items-center justify-content-between pb-sm-4 pb-3">
                    <h1 class="h2 mb-sm-0">
                        {{ __('Property for :for', ['for' => request()->query('for') == 'rent' ? 'Rent' : (request()->query('for') == 'sale' ? 'Sale' : 'Anything')]) }}
                    </h1>
                </div>
                <!-- Sorting-->
                <div class="d-flex flex-sm-row flex-column align-items-sm-center align-items-stretch my-2">
                    <div class="d-flex align-items-center flex-shrink-0">
                        <label class="fs-sm text-nowrap me-2 pe-1" for="sortby_search"><i
                                class="fi-arrows-sort text-muted mt-n1 me-2"></i>{{ __('Sort by') }}:</label>
                        <select class="form-select-sm form-select" id="sortby_search" name="sort_by">
                            <option value="newest" @selected(request()->query('sort_by') == 'newest')>{{ __('Newest') }}</option>
                            <option value="popularity" @selected(request()->query('sort_by') == 'popularity')>{{ __('Popularity') }}</option>
                            <option value="low-high-price" @selected(request()->query('sort_by') == 'low-high-price')>{{ __('Low - High Price') }}
                            </option>
                            <option value="high-low-price" @selected(request()->query('sort_by') == 'high-low-price')>{{ __('High - Low Price') }}
                            </option>
                            <option value="high-rating" @selected(request()->query('sort_by') == 'high-rating')>{{ __('High rating') }}</option>
                            <option value="average-rating" @selected(request()->query('sort_by') == 'average-rating')>{{ __('Average Rating') }}
                            </option>
                        </select>
                    </div>
                    <hr class="d-none d-sm-block w-100 mx-4">
                    <div class="d-none d-sm-flex align-items-center text-muted flex-shrink-0">
                        <i class="fi-check-circle me-2"></i>
                        <span class="fs-sm mt-n1">{{ __(':count results', ['count' => $properties->total()]) }}</span>
                    </div>
                </div>
                <!-- Catalog grid-->
                <div class="row g-4 py-4">
                    <!-- Item-->
                    @each('partials.listing.search.grid', $properties, 'property', 'partials.not_found')
                </div>
                <!-- Pagination-->
                {{ $properties->appends(request()->query())->links() }}
            </div>
        </div>
    </div>
</x-master-layout>
