<section class="pb-md-4 pb-lg-5 container mb-5 pb-2">
    <div class="row g-4">
        @foreach ($content[0]['data']['values'] as $value)
            <!-- Item-->
            <div class="col-md-4">
                <a class="icon-box card card-hover h-100"
                    @if ($value['link']) href="{{ $value['link'] }}" @endif>
                    <div class="card-body">
                        <div class="icon-box-media text-primary rounded-circle mb-3 shadow-sm">
                            {!! $value['icon'] !!}
                        </div><span class="d-block text-body mb-1">{{ $value['subtitle'] }}</span>
                        <h3 class="h4 icon-box-title mb-0 opacity-90">{{ $value['title'] }}</h3>
                    </div>
                </a>
            </div>
        @endforeach
    </div>
</section>
