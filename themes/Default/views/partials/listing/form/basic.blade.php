<section x-data="{

    property_type: @js(old('property_type', $property->property_type) ?? ''),
    {{-- category: @js($property->category_id), --}}

}" class="card card-body mb-4 border-0 p-4 shadow-sm" id="basic-info">
    <h2 class="h4 mb-4"><i class="fi-info-circle text-primary fs-5 mt-n1 me-2"></i>{{ __('Basic info') }}</h2>
    <div class="mb-3">
        <label class="form-label" for="ap-title">{{ __('Title') }} <span class="text-danger">*</span></label>
        <input name="title" class="form-control" type="text" id="ap-title"
            placeholder="{{ __('Title for your property') }}" required value="{{ old('title', $property->title) }}">
    </div>
    <div class="row">
        <div class="col-sm-6 mb-3">
            <label class="form-label" for="ap-category">{{ __('Category') }} <span class="text-danger">*</span></label>
            <select x-model="property_type" name="property_type" class="form-select" id="ap-category" required>
                {{-- <option value="" disabled hidden>{{ __('Choose category') }}</option> --}}
                <option value="0" @selected(old('property_type', $property->property_type) == 0)>{{ __('For sale') }}</option>
                <option value="1" @selected(old('property_type', $property->property_type) == 1)>{{ __('For rent') }}</option>
            </select>
        </div>
        <div class="col-sm-6 mb-3">
            <label class="form-label" for="ap-type">{{ __('Property type') }} <span
                    class="text-danger">*</span></label>
            <select name="category_id" class="form-select" id="ap-type" required>
                <option value="">{{ __('Choose property type') }}</option>
                @foreach ($types as $type)
                    <option value="{{ $type->id }}" @selected(old('category_id', $property->category_id) == $type->id)>{{ $type->title }}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="row mb-3" x-show="property_type == '1'" x-transition>
        <div class="col-sm-6">
            <label class="form-label" for="rent_interval">{{ __('Rent Interval') }} <span
                    class="text-danger">*</span></label>
            <select name="rent_interval" id="rent_interval" class="form-control">
                <option value="day" @selected(old('rent_interval', $property->rent_interval) == 'day')>{{ __('Day') }}</option>
                <option value="week" @selected(old('rent_interval', $property->rent_interval) == 'week')>{{ __('Week') }}</option>
                <option value="month" @selected(old('rent_interval', $property->rent_interval) == 'month')>{{ __('Month') }}</option>
                <option value="year" @selected(old('rent_interval', $property->rent_interval) == 'year')>{{ __('Year') }}</option>
            </select>
        </div>
        <div class="col-sm-6">
            <label class="form-label" for="rent_duration">{{ __('Rent Duration') }} <span
                    class="text-danger">*</span></label>
            <input name="rent_duration" type="text" class="form-control" id="rent_duration"
                value="{{ old('rent_duration', $property->rent_duration) }}">
        </div>
    </div>
    <div class="form-label fw-bold pb-2 pt-3">{{ __('Are you listing on Finder as part of a company?') }} <span
            class="text-danger">*</span></div>
    @foreach ($listingAs as $item)
        <div class="form-check">
            <input class="form-check-input" type="radio" id="ap-company-{{ $item->id }}" name="listing_as_id"
                value="{{ $item->id }}" @checked($item->id == old('listing_as_id', $property->listing_as_id))>
            <label class="form-check-label" for="ap-company-{{ $item->id }}">{{ $item->title }}</label>
        </div>
    @endforeach
</section>
