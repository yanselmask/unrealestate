 <section class="mt-n3 mt-lg-0 container mb-5">
     <div class="tns-carousel-wrapper tns-nav-outside tns-nav-outside-flush mx-n2">
         <div class="tns-carousel-inner row gx-4 mx-0 py-3"
             data-carousel-options='{"items": {{ count($content[0]['data']['services']) }}, "controls": false, "responsive": {"0":{"items":1},"500":{"items":2},"768":{"items":3}}}'>
             @foreach ($content[0]['data']['services'] as $item)
                 <div class="col">
                     <div class="card card-hover h-100 pb-sm-3 px-sm-3 border-0 pb-2 text-center">
                         <img class="d-block mx-auto my-3" src="{{ $item['image'] }}" width="256"
                             alt="{{ $item['heading'] }}" />
                         <div class="card-body">
                             <h2 class="h4 card-title">{{ $item['heading'] }}</h2>
                             <p class="card-text fs-sm">
                                 {{ $item['description'] }}
                             </p>
                         </div>
                         <div class="card-footer border-0 pt-0">
                             <a class="btn btn-outline-primary stretched-link" href=" {{ $item['btn_link'] }}"
                                 target="{{ $item['btn_target'] }}">
                                 {{ $item['btn_text'] }}
                             </a>
                         </div>
                     </div>
                 </div>
             @endforeach
         </div>
     </div>
 </section>
