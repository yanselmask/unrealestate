      <section class="pb-sm-3 pb-lg-4 container mb-5">
          <div class="bg-secondary rounded-3">
              <div class="col-md-11 col-12 offset-md-1 p-md-0 d-flex align-items-center justify-content-between p-2">
                  <div class="me-md-5 py-md-5 px-md-0 p-4" style="max-width: 526px;">
                      <h2 class="mb-md-4">
                          {!! $content[0]['data']['heading'] !!}
                      </h2>
                      <p class="pb-md-3 fs-lg mb-4">{{ $content[0]['data']['description'] }}</p><a
                          class="btn btn-lg btn-primary" href="{{ $content[0]['data']['btn_link'] }}"
                          target="{{ $content[0]['data']['btn_target'] }}">{!! $content[0]['data']['btn_text'] !!}</a>
                  </div>
                  <div class="col-4 d-md-block d-none align-self-end px-0"><img class="mt-n5"
                          src="{{ $content[0]['data']['image'] }}" width="406"
                          alt="{{ $content[0]['data']['heading'] }}"></div>
              </div>
          </div>
      </section>
