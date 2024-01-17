   <section class="pb-lg-4 container mb-5 pb-2">
       <div class="d-flex align-items-end justify-content-sm-between justify-content-center mb-3">
           <h2 class="h3 text-sm-start mb-0 text-center">{{ $content[0]['data']['heading'] }}</h2>
           @if (count($content[0]['data']['team']) > 4)
               <div class="tns-carousel-controls tns-controls-static d-sm-flex d-none ms-4" id="external-controls">
                   <button class="mx-2" type="button"><i class="fi-chevron-left"></i></button>
                   <button class="mx-2" type="button"><i class="fi-chevron-right"></i></button>
               </div>
           @endif
       </div>
       <!-- Team carousel-->
       <div class="tns-carousel-wrapper tns-nav-outside tns-nav-outside-flush mx-n2">
           <div class="tns-carousel-inner row gx-4 mx-0 pb-4 pt-3"
               data-carousel-options="{&quot;controlsContainer&quot;: &quot;#external-controls&quot;, &quot;responsive&quot;: {&quot;0&quot;:{&quot;items&quot;:1},&quot;500&quot;:{&quot;items&quot;:2},&quot;768&quot;:{&quot;items&quot;:3},&quot;992&quot;:{&quot;items&quot;:4, &quot;nav&quot;: false}}}">
               @foreach ($content[0]['data']['team'] as $agent)
                   <!-- Team slide-->
                   <div class="col">
                       <div class="card @if ($loop->index % 2 == 0) mt-md-4 @endif border-0 shadow-sm"><img
                               class="card-img-top" src="{{ $agent['image'] }}" alt="{{ $agent['name'] }}">
                           <div class="card-body text-center">
                               <h3 class="h5 card-title mb-2">{{ $agent['name'] }}</h3><span
                                   class="d-inline-block fs-sm mb-3">{{ $agent['position'] }}</span>
                               @isset($agent['social'])
                                   <div class="pt-1">
                                       @foreach ($agent['social'] as $social)
                                           <a class="btn btn-icon btn-light-primary btn-xs rounded-circle mx-2 shadow-sm"
                                               href="{{ $social['value'] }}"><i class="fi-{{ $social['key'] }}"></i>
                                           </a>
                                       @endforeach
                                   </div>
                               @endisset
                           </div>
                       </div>
                   </div>
               @endforeach
           </div>
       </div>
   </section>
