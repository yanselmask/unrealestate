<section class="container mb-5">
    <div class="row row-cols-lg-6 row-cols-sm-3 row-cols-2 g-3 g-xl-4">
        @foreach (collect($content[0]['data']['categories'])->slice(0, 5) as $value)
            @php
                $category = App\Models\Category::find($value['category']);
            @endphp
            <div class="col">
                <a class="icon-box card card-body h-100 card-hover h-100 border-0 text-center shadow-sm"
                    href="{{ route('home.listing.search', ['property_type' => [$category->id]]) }}">
                    <div class="icon-box-media bg-faded-primary text-primary rounded-circle mx-auto mb-3">
                        {!! $category->x_icon !!}
                    </div>
                    <h3 class="icon-box-title fs-base mb-0">{{ $category->title }}
                    </h3>
                </a>
            </div>
        @endforeach
        @if (count($content[0]['data']['categories']) > 5)
            <div class="col">
                <div class="dropdown h-100">
                    <a class="icon-box card card-body h-100 card-hover border-0 text-center shadow-sm" href="#"
                        data-bs-toggle="dropdown">
                        <div class="icon-box-media bg-faded-primary text-primary rounded-circle mx-auto mb-3">
                            <i class="fi-dots-horisontal"></i>
                        </div>
                        <h3 class="icon-box-title fs-base mb-0">{{ __('More') }}</h3>
                    </a>
                    <div class="dropdown-menu dropdown-menu-end my-1">
                        @foreach (collect($content[0]['data']['categories'])->slice(5) as $value)
                            @php
                                $category = App\Models\Category::find($value['category']);
                            @endphp
                            <a class="dropdown-item fw-bold"
                                href="{{ route('home.listing.search', ['property_type' => [$category->id]]) }}">
                                {!! $category->x_icon !!}{{ $category->title }}
                            </a>
                        @endforeach
                    </div>
                </div>
            </div>
        @endif
    </div>
</section>
