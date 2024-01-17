<x-master-layout>
    @include('partials.sectionable', [
        'sections' => $page->sections()->orderBy('sort_order')->get(),
    ])
</x-master-layout>
