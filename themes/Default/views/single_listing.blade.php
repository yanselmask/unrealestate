<x-master-layout>
    <!-- Page content-->
    <!-- Review modal-->
    @include('partials.listing.single.review_modal')
    <!-- Page header-->
    @include('partials.listing.single.page_header')
    <!-- Gallery-->
    @include('partials.listing.single.gallery')
    <!-- Post content-->
    @include('partials.listing.single.post_content')
    <!-- Recently viewed-->
    @include('partials.listing.single.recently')

    <x-slot name="js_vendor">
        <script>
            let sortBy = document.getElementById('reviews-sorting');
            sortBy.addEventListener('change', (e) => {
                let currentUrl = new URL(@js(request()->fullUrl()))
                currentUrl.searchParams.set('sort_by', e.target.value);

                //Load new url
                window.location.href = currentUrl.toString() + '#reviews';
            })
        </script>
    </x-slot>
</x-master-layout>
