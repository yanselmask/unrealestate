@php
    $packages = App\Models\Package::all();
@endphp
<section class="pb-lg-4 container mb-5 pb-2">
    <h2 class="h3 mb-4 pb-2">{{ $content[0]['data']['heading'] }}</h2>
    <div class="row">
        @foreach ($packages as $package)
            <div class="col-sm-6 col-md-4 mb-4">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <img class="d-block mx-auto mb-4 mt-2" src="{{ $package->image }}" width="72" alt="Icon">
                        <h2 class="h5 fw-normal mb-0 py-1 text-center">{{ $package->name }}</h2>
                        <div class="d-flex align-items-end justify-content-center mb-4">
                            <div class="h1 mb-0">{{ $package->price }}</div>
                            <div class="pb-2 ps-2">/{{ $package->interval }}</div>
                        </div>
                        <ul class="list-unstyled d-block mx-auto mb-0" style="max-width: 16rem;">
                            @foreach ($package->features as $feature)
                                <li class="d-flex @if (!$feature['checked']) text-muted @endif">
                                    @if ($feature['checked'])
                                        <i class="fi-check text-primary fs-sm me-2 mt-1"></i>
                                    @else
                                        <i class="fi-x fs-xs me-2 mt-2"></i>
                                    @endif
                                    <span>{{ $feature['value'] }}</span>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="card-footer border-0 py-2">
                        <div class="border-top pb-3 pt-4 text-center">
                            @auth
                                @if (request()->user()
                                        ?->packages()
                                        ?->first()?->id === $package->id && request()->user()?->propertiesRestants > 0)
                                    <a class="btn btn-primary" href="#">{{ __('Actived') }}</a>
                                @else
                                    <a class="btn btn-outline-primary"
                                        href="{{ route('checkout.show', $package) }}">{{ __('Choose plan') }}</a>
                                @endif
                            @else
                                <a class="btn btn-outline-primary" href="{{ route('login') }}">{{ __('Login') }}</a>
                            @endauth
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</section>
