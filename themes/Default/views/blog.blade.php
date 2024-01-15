<x-master-layout>
    <div class="mb-md-4 container mt-5 py-5">
        <!-- Breadcrumb-->
        @include('partials.breadcrumb', [
            'before' => [
                'Home' => route('home'),
            ],
            'active' => 'Blog',
        ])
        <h1 class="d-flex align-items-end justify-content-between mb-4">
            {{ __(':site news', ['site' => setting('site_name')]) }}</h1>
        @if ($featureds->count() > 0)
            <!-- Sponsored posts carousel-->
            <div class="tns-carousel-wrapper @if ($featureds->count() == 1) mb-3 @endif">
                <div class="tns-carousel-inner"
                    data-carousel-options="{&quot;mode&quot;: &quot;gallery&quot;, &quot;nav&quot;: false, &quot;controlsContainer&quot;: &quot;#sponsored-news-controls&quot;}">
                    <!-- Item-->
                    @each('partials.blog.featured', $featureds, 'post')
                </div>
            </div>
            <!-- Carousel custom controls-->
            <div class="tns-carousel-controls mb-lg-3 mt-4 pb-5 pt-2" id="sponsored-news-controls">
                <button class="me-3" type="button"><i class="fi-chevron-left fs-xs"></i></button>
                <button type="button"><i class="fi-chevron-right fs-xs"></i></button>
            </div>
        @endif
        <form action="">
            <!-- Search bar + filters-->
            <div class="row gy-3 mb-4 pb-2">
                @if (request()->query('s'))
                    <div class="col-12">
                        <span>{{ __('Search results for: ":term"', ['term' => request()->query('s', '')]) }}</span>
                    </div>
                @endif
                <div class="col-md-4 order-md-1 order-2">
                    <div class="position-relative">
                        <input name="s" class="form-control pe-5" type="text"
                            placeholder="{{ __('Search articles by keywords...') }}"
                            value="{{ request()->query('s', '') }}">
                        <i class="fi-search position-absolute top-50 translate-middle-y end-0 me-3"></i>
                    </div>
                </div>
                <div class="col-lg-6 col-md-8 offset-lg-2 order-md-2 order-1">
                    <div class="row gy-3">
                        <div class="col-6 d-flex flex-sm-row flex-column align-items-sm-center">
                            <label class="d-inline-block me-sm-2 mb-sm-0 text-nowrap mb-2" for="categories"><i
                                    class="fi-align-left mt-n1 me-2 align-middle opacity-70"></i>{{ __('Category') }}:</label>
                            <select name="category" class="form-select" id="categories">
                                <option value="">{{ __('All') }}</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}" @selected($category->id == request()->query('category'))>
                                        {{ $category->title }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-6 d-flex flex-sm-row flex-column align-items-sm-center">
                            <label class="d-inline-block me-sm-2 mb-sm-0 text-nowrap mb-2" for="sortby"><i
                                    class="fi-arrows-sort mt-n1 me-2 align-middle opacity-70"></i>{{ __('Sort by') }}:</label>
                            <select name="sort" class="form-select" id="sortby">
                                <option value="desc" @selected(request()->query('sort') == 'desc')>{{ __('Newest') }}</option>
                                <option value="asc" @selected(request()->query('sort') == 'asc')>{{ __('Oldest') }}</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
        </form>
        <!-- Articles grid-->
        <div class="row row-cols-md-2 row-cols-1 gy-md-5 gy-4 mb-lg-5 mb-4">
            <!-- Article-->
            @each('partials.blog.grid', $posts, 'post', 'partials.not_found')
        </div>
        <!-- Pagination-->
        {{ $posts->appends(request()->query())->links() }}
    </div>
</x-master-layout>
