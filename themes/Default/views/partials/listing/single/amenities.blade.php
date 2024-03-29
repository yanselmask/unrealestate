 <div class="pb-md-3 mb-4">
     @foreach ($property->facilities()->where('type', 'checkbox')->get() as $facility)
         <h3 class="h4">{{ $facility->name }}</h3>
         <ul class="list-unstyled row row-cols-lg-3 row-cols-md-2 row-cols-1 gy-1 text-nowrap mb-1">
             @foreach (explode(',', facility_value($property->id, $facility->id)) as $value)
                 <li class="col">
                     {!! collect($facility->values)->where('value', $value)->first()['icon'] !!}
                     {{ $value }}
                 </li>
             @endforeach
         </ul>
     @endforeach
 </div>
