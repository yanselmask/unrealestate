 <section class="pb-lg-4 container mb-5 pb-2">
     <h2 class="h3 text-md-start mb-4 text-center">{{ $content[0]['data']['heading'] }}</h2>
     <div class="tns-carousel-wrapper tns-nav-outside tns-nav-outside-flush">
         <div class="tns-carousel-inner"
             data-carousel-options='{"items": {{ count($content[0]['data']['logos']) }}, "controls": false, "responsive": {"0":{"items":2}, "500":{"items":4}, "992":{"items":5, "gutter": 16}, "1200":{"items":6, "gutter": 24}}}'>
             @foreach ($content[0]['data']['logos'] as $logo)
                 <div>
                     <a class="swap-image" href="{{ $logo['link'] }}">
                         <img class="swap-to" src="{{ $logo['color'] }}" alt="{{ __('Logo') }}" width="196" />
                         <img class="swap-from" src="{{ $logo['gray'] }}" alt="{{ __('Logo') }}" width="196" />
                     </a>
                 </div>
             @endforeach
         </div>
     </div>
 </section>
