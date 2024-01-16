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
            ],
            'active' => $agent->fullname,
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
                            <a href="{{ route('agent.listing.reviews', $agent) }}">
                                {{ __('(:count reviews)', ['count' => $agent->receivedReviews->count()]) }}
                            </a>
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
                <h1 class="h2 text-sm-start mb-4 text-center">{{ __('Property offers') }}</h1>
                <!-- Nav tabs + Sorting-->
                <div class="d-flex flex-column flex-sm-row align-items-center justify-content-between mb-4">
                    <ul class="nav nav-tabs mb-sm-0 flex-nowrap" role="tablist">
                        <li class="nav-item"><a class="nav-link fs-sm active" href="#for-rent" data-bs-toggle="tab"
                                role="tab" aria-controls="for-rent" aria-selected="true">For rent</a></li>
                        <li class="nav-item"><a class="nav-link fs-sm" href="#for-sale" data-bs-toggle="tab"
                                role="tab" aria-controls="for-sale" aria-selected="false">For sale</a></li>
                    </ul>
                </div>
                <div class="tab-content">
                    <!-- For rent tab-->
                    <div class="tab-pane fade show active" id="for-rent" role="tabpanel">
                        <div class="row g-4 g-md-3 g-lg-4 pt-2">
                            <!-- Item-->
                            @each('partials.listing.search.grid', $rents, 'property', 'partials.not_found')
                        </div>
                        {{ $rents->links() }}
                    </div>
                    <!-- For sale tab-->
                    <div class="tab-pane fade" id="for-sale" role="tabpanel">
                        <div class="row g-4 g-md-3 g-lg-4 py-2">
                            <!-- Item-->
                            @each('partials.listing.search.grid', $sales, 'property', 'partials.not_found')
                        </div>
                        {{ $sales->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-master-layout>
