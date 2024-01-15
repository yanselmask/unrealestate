 @if ($menu && $menu->items)
     @foreach ($menu->items as $item)
         @if ($item['children'])
             <!-- Menu items-->
             <li class="nav-item dropdown active">
                 <a class="nav-link dropdown-toggle {{ $item['data']['classes'] }}"
                     @if ($item['type'] == 'post') href="{{ route('blog.show', $item['data']['url']) }}" @endif
                     @if ($item['type'] == 'page') href="{{ route('pages.show', $item['data']['url']) }}" @endif
                     @if ($item['type'] == 'external-link') href="{{ $item['data']['url'] }}" @endif role="button"
                     data-bs-toggle="dropdown" aria-expanded="false"
                     target="{{ $item['data']['target'] }}">{!! $item['data']['icon'] !!}&nbsp;{!! $item['label'] !!}
                     @isset($item['data']['divider'])
                         <span class="d-none d-lg-block position-absolute top-50 translate-middle-y border-end end-0"
                             style="width: 1px; height: 30px;"></span>
                     @endisset
                 </a>
                 <ul class="dropdown-menu">
                     @include('partials.loop-item-menu', [
                         'items' => $item['children'],
                     ])
                 </ul>
             </li>
         @else
             <!-- Menu items-->
             <li class="nav-item">
                 <a class="nav-link {{ $item['data']['classes'] }}"
                     @if ($item['type'] == 'post') href="{{ route('blog.show', $item['data']['url']) }}" @endif
                     @if ($item['type'] == 'page') href="{{ route('pages.show', $item['data']['url']) }}" @endif
                     @if ($item['type'] == 'external-link') href="{{ $item['data']['url'] }}" @endif
                     target="{{ $item['data']['target'] }}">{!! $item['data']['icon'] !!}&nbsp;{!! $item['label'] !!}
                     @isset($item['data']['divider'])
                         <span class="d-none d-lg-block position-absolute top-50 translate-middle-y border-end end-0"
                             style="width: 1px; height: 30px;"></span>
                     @endisset
                 </a>
             </li>
             <span class="d-none d-lg-block position-absolute top-50 translate-middle-y border-end end-0"
                 style="width: 1px; height: 30px;"></span>
         @endif
     @endforeach
 @endif
