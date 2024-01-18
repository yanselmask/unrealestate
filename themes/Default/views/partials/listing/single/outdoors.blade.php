 <div class="pb-md-3 mb-4">
     <h3 class="h4">{{ __('Outdoors') }}</h3>
     <ul class="list-unstyled row row-cols-lg-3 row-cols-md-2 row-cols-1 gy-1 text-nowrap mb-1">
         @foreach ($property->outdoors as $outdoor)
             <li class="col">
                 {!! $outdoor->icon !!} {{ $outdoor->name }} ({{ $outdoor->pivot->distance }}
                 {{ __(env('DISTANCE_TYPE')) }})
             </li>
         @endforeach
     </ul>
 </div>
