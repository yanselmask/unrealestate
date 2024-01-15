<section class="container mb-4 overflow-auto pb-3" data-simplebar>
    <div class="row g-2 g-md-3 gallery" data-thumbnails="true" style="min-width: 30rem;">
        @if ($property->first_image_media)
            <div class="col-8">
                <a class="gallery-item rounded-md-3 rounded" href="{{ $property->first_image_media }}">
                    <img src="{{ $property->first_image_media }}" alt="{{ $property->title }}">
                </a>
            </div>
        @endif
        <div class="col-4">
            @if ($property->sec_image_media)
                <a class="gallery-item rounded-md-3 mb-md-3 mb-2 rounded" href="{{ $property->sec_image_media }}">
                    <img src="{{ $property->sec_image_media }}" alt="{{ $property->title }}">
                </a>
            @endif
            @if ($property->tre_image_media)
                <a class="gallery-item rounded-md-3 rounded" href="{{ $property->tre_image_media }}">
                    <img src="{{ $property->tre_image_media }}" alt="{{ $property->title }}">
                </a>
            @endif
        </div>
        @if ($property->restsImagesMedia)
            <div class="col-12">
                <div class="row g-2 g-md-3">
                    @foreach ($property->restsImagesMedia->slice(0, 4) as $image)
                        <div class="col">
                            <a class="gallery-item rounded-1 rounded-md-2" href="{{ $image->getUrl('single') }}">
                                <img src="{{ $image->getUrl('single') }}" alt="{{ $property->title }}">
                            </a>
                        </div>
                    @endforeach
                    <div class="col">
                        <a class="gallery-item @if ($property->restsImagesMedia->count() > 5) more-item @endif rounded-1 rounded-md-2"
                            href="{{ $property->restsImagesMedia[5]->getUrl('single') }}">
                            <img src="{{ $property->restsImagesMedia[5]->getUrl('single') }}"
                                alt="{{ $property->title }}">
                            @if ($property->restsImagesMedia->count() > 5)
                                <span
                                    class="gallery-item-caption fs-base">+{{ $property->restsImagesMedia->count() - 5 }}
                                    <span class='d-none d-md-inline'>{{ __('photos') }}</span>
                                </span>
                            @endif
                        </a>
                    </div>
                    @foreach ($property->restsImagesMedia->slice(5) as $image)
                        <div class="col d-none">
                            <a class="gallery-item rounded-1 rounded-md-2" href="{{ $image->getUrl('single') }}">
                                <img src="{{ $image->getUrl('single') }}" alt="{{ $property->title }}">
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif
    </div>
</section>
