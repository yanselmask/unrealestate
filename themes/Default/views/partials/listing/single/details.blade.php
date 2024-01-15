 <div class="pb-md-3 mb-4">
     <h3 class="h4">{{ __('Property Details') }}</h3>
     <ul class="list-unstyled mb-0">
         <li><b>{{ __('Type') }}: </b>{{ $property->category->title }}</li>
         @foreach ($property->facilities()->whereIn('type', ['radio', 'textbox'])->get() as $facility)
             <li><b>{{ $facility->name }}: </b>{{ facility_value($property->id, $facility->id) }}</li>
         @endforeach
     </ul>
 </div>
