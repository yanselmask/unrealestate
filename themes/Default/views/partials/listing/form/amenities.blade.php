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
                   @if ($facility->values)
                       <div class="mb-4">
                           <label class="form-label" for="facility-{{ $facility->id }}">{{ $facility->name }}</label>
                           <select name="details[{{ $facility->id }}]" class="form-select" id="facility-{{ $facility->id }}">
                               @foreach ($facility->values as $value)
                                   <option @selected($value['value'] == facility_value($property->id, $facility->id)) value="{{ $value['value'] }}">
                                       {{ $value['value'] }}
                                   </option>
                               @endforeach
                           </select>
                       </div>
                   @endif
               @break

               @case('checkbox')
                   @if ($facility->values)
                       <div class="mb-4">
                           <label class="form-label d-block fw-bold mb-2 pb-1">{{ $facility->name }}</label>

                           <div class="row">
                               @foreach ($facility->values as $value)
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
           @endif
       @break

       @case('radio')
           @if ($facility->values)
               <div class="mb-4" style="max-width: 25rem;">
                   <label class="form-label d-block fw-bold mb-2 pb-1">{{ $facility->name }}</label>
                   <div class="btn-group btn-group-sm" role="group">
                       @foreach ($facility->values as $value)
                           <input @checked(facility_value($property->id, $facility->id) == $value['value']) name="details[{{ $facility->id }}]" class="btn-check"
                               type="radio" id="value-{{ $loop->index }}-{{ $facility->id }}"
                               value="{{ $value['value'] }}">
                           <label class="btn btn-outline-secondary fw-normal"
                               for="value-{{ $loop->index }}-{{ $facility->id }}">{{ $value['value'] }}</label>
                       @endforeach
                   </div>
               </div>
           @endif
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
