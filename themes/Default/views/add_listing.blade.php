<x-master-layout>
    <div class="mb-md-4 container mt-5 py-5">
        <div class="row">
            <!-- Page content-->
            <div class="col-lg-8">
                <!-- Breadcrumb-->
                @include('partials.breadcrumb', [
                    'before' => [
                        'Home' => route('home'),
                    ],
                    'active' => __('Add property'),
                ])
                <!-- Title-->
                <div class="mb-4">
                    <h1 class="h2 mb-0">{{ __('Add property') }}</h1>
                </div>
                <form action="{{ route('home.listing.store') }}" method="POST" x-data="{
                    category: @js($property->category_id),
                }">
                    @csrf
                    <!-- Basic info-->
                    @include('partials.listing.form.basic')
                    <!-- Location-->
                    @include('partials.listing.form.location')
                    <!-- Property outdoors-->
                    @include('partials.listing.form.outdoors')
                    <!-- Property details-->
                    @include('partials.listing.form.detail')
                    <!-- Price-->
                    @include('partials.listing.form.price')
                    <!-- Photos / video-->
                    @include('partials.listing.form.media')
                    <!-- Contacts-->
                    @include('partials.listing.form.contacts')
                    <!-- Action buttons -->
                    <section class="d-sm-flex justify-content-between pt-2">
                        <button class="btn btn-primary btn-lg d-block mb-2">
                            {{ __('Save and continue') }}
                        </button>
                    </section>
                </form>
            </div>
        </div>
    </div>
</x-master-layout>
