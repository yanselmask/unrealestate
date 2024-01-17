 @foreach ($items as $child)
     @if ($child['children'])
         <li class="dropdown">
             <a class="dropdown-item dropdown-toggle {{ $child['data']['classes'] }}"
                 @if ($child['type'] == 'post') href="{{ route('blog.show', $child['data']['url']) }}" @endif
                 @if ($child['type'] == 'page') href="{{ route('pages.show', $child['data']['url']) }}" @endif
                 @if ($child['type'] == 'external-link') href="{{ $child['data']['url'] }}" @endif role="button"
                 data-bs-toggle="dropdown" aria-expanded="false">{!! $child['data']['icon'] !!}&nbsp;{!! $child['label'] !!}
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
                 @if ($child['type'] == 'post') href="{{ route('blog.show', $child['data']['url']) }}" @endif
                 @if ($child['type'] == 'page') href="{{ route('pages.show', $child['data']['url']) }}" @endif
                 @if ($child['type'] == 'external-link') href="{{ $child['data']['url'] }}" @endif>{!! $child['data']['icon'] !!}&nbsp;{!! $child['label'] !!}</a>
         </li>
     @endif
 @endforeach
