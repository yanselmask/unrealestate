    <section class="mb-xl-5 pb-lg-4 container mb-2">
        <h2 class="h3 mb-4">{{ $content[0]['data']['heading'] }}</h2>
        <!-- Features carousel-->
        <div class="tns-carousel-wrapper tns-nav-outside">
            <div class="tns-carousel-inner"
                data-carousel-options="{&quot;loop&quot;: false, &quot;controls&quot;: false, &quot;responsive&quot;: {&quot;0&quot;:{&quot;items&quot;:1, &quot;gutter&quot;: 16},&quot;500&quot;:{&quot;items&quot;:2, &quot;gutter&quot;: 20},&quot;768&quot;:{&quot;items&quot;:3, &quot;gutter&quot;: 24}}}">
                @foreach ($content[0]['data']['chooses'] as $choose)
                    <!-- Feature slide-->
                    <div>
                        <div class="card border-0">
                            <div class="card-body">
                                {!! $choose['icon'] !!}
                                <h3 class="h5 card-title pb-1">{{ $choose['heading'] }}</h3>
                                <p class="card-text">{{ $choose['description'] }}</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
