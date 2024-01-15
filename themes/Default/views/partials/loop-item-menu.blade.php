 @foreach ($items as $child)
     @if ($child['children'])
         <li class="dropdown">
             <a class="dropdown-item dropdown-toggle {{ $child['data']['classes'] }}" href="{{ $child['data']['url'] }}"
                 role="button" data-bs-toggle="dropdown"
                 aria-expanded="false">{!! $child['data']['icon'] !!}&nbsp;{!! $child['label'] !!}
             </a>
             <ul class="dropdown-menu">
                 @include('partials.loop-item-menu', [
                     'items' => $child['children'],
                 ])
             </ul>
         </li>
     @else
         <li>
             <a class="dropdown-item {{ $child['data']['classes'] }}"
                 href="{{ $child['data']['url'] }}">{!! $child['data']['icon'] !!}&nbsp;{!! $child['label'] !!}</a>
         </li>
     @endif
 @endforeach
