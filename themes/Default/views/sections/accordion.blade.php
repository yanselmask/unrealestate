<section class="container mb-5 pb-2">
    <div class="row align-items-center justify-content-center">
        @isset($content[0]['data']['heading'])
            <h2 class="h3 text-md-start mb-3 text-center">{{ $content[0]['data']['heading'] }}</h2>
        @endisset
        <!-- Accordion basic -->
        <div class="accordion" id="accordionExample">
            @foreach ($content[0]['data']['options'] as $option)
                <!-- Accordion item -->
                <div class="accordion-item">
                    <h2 class="accordion-header" id="heading-{{ $loop->index }}">
                        <button class="accordion-button @if (!$option['expanded']) collapsed @endif" type="button"
                            data-bs-toggle="collapse" data-bs-target="#collapse-{{ $loop->index }}"
                            aria-expanded="@isset($option['expanded']) true @else false @endisset"
                            aria-controls="collapse-{{ $loop->index }}">{{ $option['key'] }}</button>
                    </h2>
                    <div class="accordion-collapse @isset($option['expanded']) show  @endisset collapse"
                        aria-labelledby="heading-{{ $loop->index }}" data-bs-parent="#accordionExample"
                        id="collapse-{{ $loop->index }}">
                        <div class="accordion-body">{{ $option['value'] }}</div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
