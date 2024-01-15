<x-guest-layout>
    <div class="container pt-5 pb-lg-4 mt-5 mb-sm-2">
        <!-- Breadcrumb-->
        @include('partials.breadcrumb', [
            'before' => $before ?? [],
            'active' => $active ?? '',
        ])
        <!-- Page content-->
        <div class="row">
            <!-- Sidebar-->
            @include('profile.sidebar')
            <!-- Content-->
            <div class="col-lg-8 col-md-7 mb-5">
                @yield('content')
            </div>
        </div>
    </div>
</x-guest-layout>
