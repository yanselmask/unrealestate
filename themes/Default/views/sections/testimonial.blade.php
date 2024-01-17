      <section class="pb-xl-5 pb-md-2 container mb-5">
          <h2 class="h3 mb-3 text-center">{{ $content[0]['data']['heading'] }}</h2>
          <!-- Testimonials carousel-->
          <div
              class="tns-carousel-wrapper tns-controls-outside-lg tns-nav-outside tns-nav-outside-flush col-lg-10 mx-auto px-0">
              <div class="tns-carousel-inner" data-carousel-options="{&quot;gutter&quot;: 24}">
                  @foreach ($content[0]['data']['testimonials'] as $testimonial)
                      <!-- Testimonial slide-->
                      <div class="d-flex flex-md-row flex-column align-items-md-start mx-3 py-3"><img
                              class="d-md-block d-none rounded-3 me-4" src="{{ $testimonial['image'] }}" width="306"
                              alt="{{ __('Customer image') }}">
                          <div class="card h-100 border-0 shadow-sm">
                              <blockquote class="blockquote card-body">
                                  <p>{{ $testimonial['description'] }}</p>
                                  <footer class="d-flex align-items-center"><img src="{{ $testimonial['user_image'] }}"
                                          width="56" alt="{{ __('Logo') }}">
                                      <div class="ps-3">
                                          <h6 class="fs-base mb-0">{{ $testimonial['name'] }}</h6>
                                          <div class="text-muted fw-normal fs-sm">{{ $testimonial['position'] }}
                                          </div>
                                      </div>
                                  </footer>
                              </blockquote>
                          </div>
                      </div>
                  @endforeach
              </div>
          </div>
      </section>
