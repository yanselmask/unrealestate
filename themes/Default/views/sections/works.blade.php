      <section class="pb-lg-4 container mb-5 pb-2">
          <div class="row gy-4">
              <div class="col-md-5 col-12"><img class="d-block mx-auto" src="{{ $content[0]['data']['image'] }}"
                      alt="{{ $content[0]['data']['heading'] }}"></div>
              <div class="col-lg-6 offset-lg-1 col-md-7 col-12">
                  <h2 class="h3 mb-lg-5 mb-sm-4">{{ $content[0]['data']['heading'] }}</h2>
                  <div class="steps steps-vertical">
                      @foreach ($content[0]['data']['chooses'] as $work)
                          <div class="step active">
                              <div class="step-progress"><span class="step-number">{{ $loop->index + 1 }}</span></div>
                              <div class="step-label ms-4">
                                  <h3 class="h5 mb-2 pb-1">{{ $work['heading'] }}</h3>
                                  <p class="mb-0">{{ $work['description'] }}</p>
                              </div>
                          </div>
                      @endforeach
                  </div>
              </div>
          </div>
      </section>
