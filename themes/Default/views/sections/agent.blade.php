<section class="pb-lg-4 container mb-5 pb-2">
    <h2 class="h3 text-md-start mb-4 pb-3 text-center">
        {{ $content[0]['data']['heading'] }}
    </h2>
    <div class="tns-carousel-wrapper">
        <div class="tns-carousel-inner"
            data-carousel-options='{"items": 1, "mode": "gallery", "controlsContainer": "#agents-carousel-controls", "nav": false}'>
            @foreach ($content[0]['data']['agents'] as $agent)
                <div>
                    <div class="row align-items-center">
                        <div class="col-xl-4 d-none d-xl-block">
                            <img class="rounded-3" src="{{ $agent['agent_1'] }}" alt="{{ __('Agent picture') }}" />
                        </div>
                        <div class="col-xl-4 col-md-5 col-sm-4">
                            <img class="rounded-3" src="{{ $agent['agent_2'] }}" alt="{{ __('Agent picture') }}" />
                        </div>
                        <div class="col-xl-4 col-md-7 col-sm-8 px-sm-3 px-md-0 ms-md-n4 mt-n5 mt-sm-0 px-4 py-3">
                            <div class="card ms-sm-n5 border-0 shadow-sm">
                                <blockquote class="blockquote card-body">
                                    <h4 style="max-width: 22rem">
                                        &quot;{{ $agent['quote'] }}&quot;
                                    </h4>
                                    <p class="d-sm-none d-lg-block">
                                        {{ $agent['description'] }}
                                    </p>
                                    <footer class="d-flex justify-content-between">
                                        <div class="pe-3">
                                            <a class="text-decoration-none" href="real-estate-vendor-properties.html">
                                                <h6 class="mb-0">{{ $agent['name'] }}</h6>
                                                <div class="text-muted fw-normal fs-sm mb-3">
                                                    {{ $agent['bio'] }}
                                                </div>
                                            </a>
                                            @foreach ($agent['socials'] as $key => $value)
                                                <a class="btn btn-icon btn-light-primary btn-xs rounded-circle mb-2 me-2 shadow-sm"
                                                    href="{{ $value }}"><i class="fi-{{ $key }}"></i>
                                                </a>
                                            @endforeach
                                        </div>
                                        <div>
                                            <span class="star-rating">
                                                @for ($i = 1; $i <= $agent['stars']; $i++)
                                                    <i class="star-rating-icon fi-star-filled active"></i>
                                                @endfor
                                                @for ($i = $agent['stars'] + 1; $i <= 5; $i++)
                                                    <i class="star-rating-icon fi-star-filled"></i>
                                                @endfor
                                            </span>
                                            <div class="text-muted fs-sm mt-1">
                                                {{ __(':count reviews', ['count' => $agent['reviews']]) }}</div>
                                        </div>
                                    </footer>
                                </blockquote>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    <div class="tns-carousel-controls justify-content-center justify-content-md-start mt-md-4 my-2"
        id="agents-carousel-controls">
        <button class="mx-2" type="button">
            <i class="fi-chevron-left"></i>
        </button>
        <button class="mx-2" type="button">
            <i class="fi-chevron-right"></i>
        </button>
    </div>
</section>
