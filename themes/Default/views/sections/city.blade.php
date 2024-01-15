<section class="container mb-5 pb-2">
    <div class="d-flex align-items-center justify-content-between mb-3">
        <h2 class="h3 mb-0">{{ $content[0]['data']['heading'] }}</h2>
        <a class="btn btn-link fw-normal ms-md-3 pb-0"
            href="{{ $content[0]['data']['view_all_link'] }}">{{ __('View all') }}<i class="fi-arrow-long-right ms-2"></i>
        </a>
    </div>
    <div class="tns-carousel-wrapper tns-controls-outside-xxl tns-nav-outside tns-nav-outside-flush mx-n2">
        <div class="tns-carousel-inner row gx-4 py-md-4 mx-0 py-3"
            data-carousel-options='{"items": {{ count($content[0]['data']['cities']) }}, "responsive": {"0":{"items":1},"500":{"items":2},"768":{"items":3},"992":{"items":4}}}'>
            @foreach ($content[0]['data']['cities'] as $k => $city)
                <!-- Item-->
                <div class="col">
                    <a class="card card-hover border-0 shadow-sm" href="{{ $city['btn_link'] }}"
                        target="{{ $city['btn_target'] }}">
                        <div class="card-img-top card-img-hover">
                            <span class="img-overlay opacity-65"></span>
                            <img src="{{ $city['image'] }}" alt="{{ $city['city'] }}" />
                            <div
                                class="content-overlay d-flex align-items-center justify-content-center w-100 h-100 start-0 top-0 p-3">
                                <div class="w-100 p-1">
                                    <div class="mb-2">
                                        <h4 class="fs-xs fw-normal text-light mb-2">
                                            <i class="fi-wallet mt-n1 fs-sm me-2 align-middle"></i>
                                            {{ __(' Property for sale') }}
                                        </h4>
                                        <div class="d-flex align-items-center">
                                            <div class="progress progress-light w-100">
                                                <div class="progress-bar bg-danger" role="progressbar"
                                                    style="width: {{ $city['sales_avg'] }}%"
                                                    aria-valuenow="{{ $city['sales_avg'] }}" aria-valuemin="0"
                                                    aria-valuemax="100"></div>
                                            </div>
                                            <span class="text-light fs-sm ms-2 ps-1">{{ $city['sales_count'] }}</span>
                                        </div>
                                    </div>
                                    <div class="pt-1">
                                        <h4 class="fs-xs fw-normal text-light mb-2">
                                            <i class="fi-home mt-n1 fs-sm me-2 align-middle"></i>
                                            {{ __('Property for rent') }}
                                        </h4>
                                        <div class="d-flex align-items-center">
                                            <div class="progress progress-light w-100">
                                                <div class="progress-bar bg-success" role="progressbar"
                                                    style="width: {{ $city['rents_avg'] }}%"
                                                    aria-valuenow="{{ $city['rents_avg'] }}" aria-valuemin="0"
                                                    aria-valuemax="100"></div>
                                            </div>
                                            <span class="text-light fs-sm ms-2 ps-1">{{ $city['rents_count'] }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-body text-center">
                            <h3 class="fs-base text-nav mb-0">{{ $city['city'] }}</h3>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>
    </div>
</section>
