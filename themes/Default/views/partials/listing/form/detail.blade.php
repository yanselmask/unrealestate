<section class="card card-body mb-4 border-0 p-4 shadow-sm" id="details">
    <h2 class="h4 mb-4"><i class="fi-edit text-primary fs-5 mt-n1 me-2"></i>{{ __('Property details') }}</h2>
    <div id="cat-deps" x-show="category">
        @include('partials.listing.form.amenities')
    </div>
    <label class="form-label" for="ap-description">{{ __('Description') }}<span class="text-danger">*</span></label>
    <textarea name="description" class="form-control" id="ap-description" rows="5"
        placeholder="{{ __('Describe your property') }}">{!! old('description', $property->description) !!}</textarea>
    @push('js_vendor')
        <script>
            const easyMDE = new EasyMDE({
                element: document.getElementById('ap-description'),
                hideIcons: ["guide", "fullscreen", "side-by-side", "preview"],
            });
        </script>
    @endpush
</section>
