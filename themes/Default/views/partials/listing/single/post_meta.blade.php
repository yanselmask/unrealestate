<div class="mb-lg-5 mb-md-4 pb-lg-2 border-top py-4">
    <ul class="d-flex list-unstyled fs-sm mb-4">
        <li class="border-end me-3 pe-3">{{ __('Published') }}:
            <b>{{ site_date($property->created_at) }}</b>
        </li>
        <li class="border-end me-3 pe-3">{{ __('Ad number') }}: <b>{{ $property->id }}</b></li>
        <li class="me-3 pe-3">{{ __('Views') }}: <b>48</b></li>
    </ul>
</div>
