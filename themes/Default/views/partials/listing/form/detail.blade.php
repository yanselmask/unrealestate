<section class="card card-body mb-4 border-0 p-4 shadow-sm" id="details">
    <h2 class="h4 mb-4"><i class="fi-edit text-primary fs-5 mt-n1 me-2"></i>{{ __('Property details') }}</h2>
    <div id="cat-deps" x-show="category">
        @if ($property->id)
            @foreach ($property->category->facilities()->get() as $facility)
                @switch($facility->type)
                    @case('file')
                        <div class="mb-4">
                            <label class="form-label" for="facility-{{ $facility->id }}">{{ $facility->name }}</label>
                            <input name="details[{{ $facility->id }}]" type="file" class="form-control"
                                id="facility-{{ $facility->id }}">
                            @if (facility_value($property->id, $facility->id))
                                <a href="{{ Storage::url(facility_value($property->id, $facility->id)) }}"
                                    class="btn btn-link">{{ __('Show file') }}</a>
                            @endif
                        </div>
                    @break

                    @case('number')
                        <div class="mb-4">
                            <label class="form-label" for="facility-{{ $facility->id }}">{{ $facility->name }}</label>
                            <input name="details[{{ $facility->id }}]" type="number" class="form-control"
                                id="facility-{{ $facility->id }}" value="{{ facility_value($property->id, $facility->id) }}">
                        </div>
                    @break

                    @case('textbox')
                        <div class="mb-4">
                            <label class="form-label" for="facility-{{ $facility->id }}">{{ $facility->name }}</label>
                            <input name="details[{{ $facility->id }}]" type="text" class="form-control"
                                id="facility-{{ $facility->id }}" value="{{ facility_value($property->id, $facility->id) }}">
                        </div>
                    @break

                    @case('textarea')
                        <div class="mb-4">
                            <label class="form-label" for="facility-{{ $facility->id }}">{{ $facility->name }}</label>
                            <textarea rows="5" class="form-control" name="details[{{ $facility->id }}]" id="facility-{{ $facility->id }}">{{ facility_value($property->id, $facility->id) }}</textarea>
                        </div>
                    @break

                    @case('select')
                        <div class="mb-4">
                            <label class="form-label" for="facility-{{ $facility->id }}">{{ $facility->name }}</label>
                            <select name="details[{{ $facility->id }}]" class="form-select" id="facility-{{ $facility->id }}">
                                @foreach ($facility->value as $value)
                                    <option @selected($value['value'] == facility_value($property->id, $facility->id)) value="{{ $value['value'] }}">
                                        {{ $value['value'] }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    @break

                    @case('checkbox')
                        <div class="mb-4">
                            <label class="form-label d-block fw-bold mb-2 pb-1">{{ $facility->name }}</label>
                            <div class="row">
                                @foreach ($facility->value as $value)
                                    @if ($loop->index % 6 == 0)
                                        <div class="col-sm-4">
                                    @endif
                                    <div class="form-check">
                                        <input class="form-check-input" name="details[{{ $facility->id }}][]" type="checkbox"
                                            id="value-{{ $loop->index }}-{{ $facility->id }}" value="{{ $value['value'] }}"
                                            @checked(str_contains(facility_value($property->id, $facility->id), $value['value']))>
                                        <label class="form-check-label"
                                            for="value-{{ $loop->index }}-{{ $facility->id }}">{{ $value['value'] }}</label>
                                    </div>
                                    @if (($loop->index + 1) % 6 == 0 || $loop->last)
                            </div>
                    @endif
                @endforeach
            </div>
            </div>
        @break

        @case('radio')
            <div class="mb-4" style="max-width: 25rem;">
                <label class="form-label d-block fw-bold mb-2 pb-1">{{ $facility->name }}</label>
                <div class="btn-group btn-group-sm" role="group">
                    @foreach ($facility->value as $value)
                        <input @checked(facility_value($property->id, $facility->id) == $value['value']) name="details[{{ $facility->id }}]" class="btn-check"
                            type="radio" id="value-{{ $loop->index }}-{{ $facility->id }}" value="{{ $value['value'] }}">
                        <label class="btn btn-outline-secondary fw-normal"
                            for="value-{{ $loop->index }}-{{ $facility->id }}">{{ $value['value'] }}</label>
                    @endforeach
                </div>
            </div>
        @break

        @case('markdown')
            <div class="mb-4">
                <label class="form-label d-block fw-bold mb-2 pb-1"
                    for="facility-{{ $facility->id }}">{{ $facility->name }}</label>
                <textarea id="facility-{{ $facility->id }}" name="details[{{ $facility->id }}]" class="form-control">{{ facility_value($property->id, $facility->id) }}</textarea>
            </div>
            @push('js_vendor')
                <script>
                    new EasyMDE({
                        element: document.getElementById('facility-{{ $facility->id }}'),
                        hideIcons: ["guide", "fullscreen", "side-by-side", "preview"],
                    });
                </script>
            @endpush
        @break

        @default
    @endswitch
    @endforeach
    @endif
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
