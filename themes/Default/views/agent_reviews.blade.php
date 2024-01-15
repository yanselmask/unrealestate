<x-master-layout>
    <!-- Message modal-->
    <div class="modal fade" id="message-modal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="fs-base modal-title">{{ __('Message to :name', ['name' => $agent->fullname]) }}</h3>
                    <button class="btn-close ms-0" type="button" data-bs-dismiss="modal"></button>
                </div>
                <form class="modal-body needs-validation" action="{{ route('listing.message') }}" method="POST">
                    @csrf
                    <div class="mb-4">
                        <input type="hidden" name="receiver_id" value="{{ $agent->id }}" />
                        <textarea class="form-control @error('message') is-invalid @enderror" name="message" rows="6"
                            placeholder="{{ __('Type your message here') }}" required>{{ old('message') }}</textarea>
                        @error('message')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <button class="btn btn-primary mb-2" type="submit">
                        <i class="fi-send me-2"></i>{{ __('Send message') }}
                    </button>
                </form>
            </div>
        </div>
    </div>
    <!-- Page container-->
    <div class="mb-md-4 container mt-5 py-5">
        <!-- Breadcrumb-->
        @include('partials.breadcrumb', [
            'before' => [
                'Home' => route('home'),
                'Agents' => '#',
                $agent->fullname => route('agent.listing', $agent),
            ],
            'active' => 'Reviews',
        ])

        <div class="row">
            <!-- Sidebar (Agent's info)-->
            <aside class="col-lg-3 col-md-4 mb-5">
                <div class="pe-lg-3">
                    <img class="d-block rounded-circle mx-md-0 mx-auto mb-3" src="{{ $agent->profile_photo_url }}"
                        width="120" alt="{{ $agent->fullname }}">
                    <h2 class="h4 text-md-start mb-1 text-center">{{ $agent->fullname }}</h2>
                    <p class="text-md-start mb-2 pb-1 text-center">{{ $agent->company }}</p>
                    <div class="d-flex justify-content-center justify-content-md-start border-bottom mb-4 pb-4">
                        <span class="star-rating">
                            @for ($i = 1; $i <= Number::forHumans($agent->reviewsAvg); $i++)
                                <i class="star-rating-icon fi-star-filled active"></i>
                            @endfor
                            @for ($i = Number::forHumans($agent->reviewsAvg) + 1; $i <= 5; $i++)
                                <i class="star-rating-icon fi-star-filled"></i>
                            @endfor
                        </span>
                        <div class="text-muted ms-2">
                            {{ __('(:count reviews)', ['count' => $agent->receivedReviews->count()]) }}
                        </div>
                    </div>
                    @if ($agent->bio)
                        <div class="border-bottom mb-4 pb-4">
                            <p class="fs-sm mb-0">{{ $agent->bio }}</p>
                        </div>
                    @endif
                    <ul class="d-table list-unstyled mx-md-0 mb-md-4 mx-auto mb-3">
                        @if ($agent->phone)
                            <li class="mb-2">
                                <a class="nav-link fw-normal p-0" href="tel:{{ $agent->phone }}">
                                    <i class="fi-phone text-primary mt-n1 me-2 align-middle"></i>{{ $agent->phone }}
                                </a>
                            </li>
                        @endif
                        <li>
                            <a class="nav-link fw-normal p-0" href="mailto:{{ $agent->email }}">
                                <i class="fi-mail text-primary mt-n1 me-2 align-middle"></i>{{ $agent->email }}
                            </a>
                        </li>
                    </ul>
                    @if ($agent->socials)
                        <div class="text-md-start text-center">
                            @foreach ($agent->socials as $social => $link)
                                <a class="btn btn-icon btn-light-primary btn-xs rounded-circle mb-2 ms-2 shadow-sm"
                                    href="{{ $link }}"><i class="fi-{{ $social }}"></i>
                                </a>
                            @endforeach
                        </div>
                    @endif
                    <div class="text-md-start pt-md-2 mt-4 text-center"><a class="btn btn-primary" href="#message-modal"
                            data-bs-toggle="modal">
                            <i class="fi-chat-left fs-sm me-2"></i>{{ __('Direct message') }}
                        </a>
                    </div>
                </div>
            </aside>
            <!-- Content-->
            <div class="col-lg-9 col-md-8">
                <div class="d-flex align-items-center justify-content-between mb-4 pb-2">
                    <h1 class="h2 text-sm-start mb-0 text-center">
                        {{ __('Reviews (:count)', ['count' => $reviews->total()]) }}</h1>
                    <a class="btn btn-link btn-sm px-0" href="{{ route('agent.listing', $agent) }}">
                        <i class="fi-arrow-left fs-xs me-2 mt-0"></i>{{ __('Back to Offers') }}</a>
                </div>
                <!-- Reviews statistics-->
                <div class="d-flex align-items-center mb-2">
                    <div class="text-nowrap fs-sm me-3">
                        5 <i class="fi-star text-muted mt-n1 ms-1"></i>
                    </div>
                    <div class="progress w-100">
                        <div class="progress-bar bg-warning" role="progressbar" style="width: {{ $avgFive }}%"
                            aria-valuenow="{{ $avgFive }}" aria-valuemin="0" aria-valuemax="100">
                        </div>
                    </div>
                    <div class="flex-grow-1 fs-sm flex-shrink-0 ps-2 text-end" style="width: 3rem;">
                        {{ $avgFive }}%</div>
                </div>
                <div class="d-flex align-items-center mb-2">
                    <div class="text-nowrap fs-sm me-3">4<i class="fi-star text-muted mt-n1 ms-1"></i></div>
                    <div class="progress w-100">
                        <div class="progress-bar bg-warning" role="progressbar" style="width: {{ $avgFour }}%"
                            aria-valuenow="{{ $avgFour }}" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                    <div class="flex-grow-1 fs-sm flex-shrink-0 ps-2 text-end" style="width: 3rem;">
                        {{ $avgFour }}%</div>
                </div>
                <div class="d-flex align-items-center mb-2">
                    <div class="text-nowrap fs-sm me-3">3<i class="fi-star text-muted mt-n1 ms-1"></i></div>
                    <div class="progress w-100">
                        <div class="progress-bar bg-warning" role="progressbar" style="width: {{ $avgThree }}%"
                            aria-valuenow="{{ $avgThree }}" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                    <div class="flex-grow-1 fs-sm flex-shrink-0 ps-2 text-end" style="width: 3rem;">
                        {{ $avgThree }}%</div>
                </div>
                <div class="d-flex align-items-center mb-2">
                    <div class="text-nowrap fs-sm me-3">2<i class="fi-star text-muted mt-n1 ms-1"></i></div>
                    <div class="progress w-100">
                        <div class="progress-bar bg-warning" role="progressbar" style="width: {{ $avgTwo }}%"
                            aria-valuenow="{{ $avgTwo }}" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                    <div class="flex-grow-1 fs-sm flex-shrink-0 ps-2 text-end" style="width: 3rem;">
                        {{ $avgTwo }}%</div>
                </div>
                <div class="d-flex align-items-center mb-5">
                    <div class="text-nowrap fs-sm me-3">1<i class="fi-star text-muted mt-n1 ms-1"></i></div>
                    <div class="progress w-100">
                        <div class="progress-bar bg-warning" role="progressbar" style="width: {{ $avgOne }}%"
                            aria-valuenow="{{ $avgOne }}" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                    <div class="flex-grow-1 fs-sm flex-shrink-0 ps-2 text-end" style="width: 3rem;">
                        {{ $avgOne }}%</div>
                </div>
                <!-- Review-->
                @each('partials.listing.single.reviews', $reviews, 'review', 'partials.not_found')
                <!-- Pagination-->
                {{ $reviews->links() }}
            </div>
        </div>
    </div>
</x-master-layout>
