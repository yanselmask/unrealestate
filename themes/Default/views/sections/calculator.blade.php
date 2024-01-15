<section class="pb-lg-4 container mb-5 pb-2">
    <div class="row align-items-center">
        <div class="col-md-5">
            <img class="d-block mx-md-0 mb-md-0 mx-auto mb-4" src="{{ $content[0]['data']['image'] }}" width="416"
                alt="{{ $content[0]['data']['heading'] }}" />
        </div>
        <div class="col-xxl-6 col-md-7 text-md-start text-center">
            <h2>{{ $content[0]['data']['heading'] }}</h2>
            <p class="fs-lg pb-3">
                {{ $content[0]['data']['description'] }}
            </p>
            <a class="btn btn-lg btn-primary" href="{{ $content[0]['data']['btn_link'] }}"
                @if ($content[0]['data']['modal'] == 'no') target="{{ $content[0]['data']['btn_target'] }}" @endif
                @if ($content[0]['data']['modal'] == 'yes') data-bs-toggle="modal" @endif>
                {{ $content[0]['data']['btn_text'] }}</a>
        </div>
    </div>
</section>
