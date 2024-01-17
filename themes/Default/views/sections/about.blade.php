      <section class="container mb-5 pb-2">
          <div class="row align-items-center justify-content-center">
              <!-- Hero content-->
              <div class="col-lg-4 col-md-5 col-sm-9 order-md-1 text-md-start order-2 text-center">
                  <h1 class="mb-4">{{ $content[0]['data']['heading'] }}</h1>
                  <p class="fs-lg mb-4 pb-3">{{ $content[0]['data']['description'] }}</p>
                  <a class="btn btn-lg btn-primary" href="{{ $content[0]['data']['btn_link'] }}"
                      target="{{ $content[0]['data']['btn_target'] }}">{{ $content[0]['data']['btn_text'] }}</a>
              </div>
              <!-- Hero carousel-->
              <div class="col-lg-7 col-md-6 offset-md-1 col-12 order-md-2 order-1">
                  <div class="tns-carousel-wrapper tns-controls-static tns-nav-outside">
                      <div class="tns-carousel-inner"
                          data-carousel-options="{&quot;loop&quot;: true, &quot;gutter&quot;: 16}">
                          @foreach ($content[0]['data']['images'] as $image)
                              <div><img class="rounded-3" src="{{ $image['image'] }}" alt="{{ __('Carousel image') }}">
                              </div>
                          @endforeach
                      </div>
                  </div>
              </div>
          </div>
      </section>
