<section class="card card-body mb-4 border-0 p-4 shadow-sm" id="outdoors">
    <h2 class="h4 mb-4"><i class="fi-cocktail text-primary fs-5 mt-n1 me-2"></i>{{ __('Outdoors') }}</h2>
    <div class="row">
        @foreach ($outdoors as $outdoor)
            <div class="col-4" x-data="{ showText: @js(old('outdoors.' . $outdoor->id, outdoor_value($property->id, $outdoor->id))) }">
                <!-- Outdoor -->
                <div class="form-check form-check-inline">
                    <input x-model="showText" class="form-check-input" id="outdoor-id-{{ $outdoor->id }}" type="checkbox"
                        :checked="showText">
                    <label class="form-check-label" for="outdoor-id-{{ $outdoor->id }}">{{ $outdoor->name }}</label>
                </div>
                <div x-show="showText">
                    <input type="text" name="outdoors[{{ $outdoor->id }}]" class="form-control"
                        placeholder="{{ __('Enter the distance') }}"
                        value="{{ old('outdoors.' . $outdoor->id, outdoor_value($property->id, $outdoor->id)) }}">
                </div>
            </div>
        @endforeach
    </div>
</section>
