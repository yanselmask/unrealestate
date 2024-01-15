 <section class="pb-md-4 container mb-5">
     @php
         $properties = collect(); // Inicializa una colección vacía

         foreach ($content[0]['data']['offers'] as $id) {
             $property = App\Models\Property::findOrFail($id);
             $properties = $properties->merge([$property]);
         }

         $flattenedProperties = $properties->flatten();

     @endphp
     <div class="d-flex align-items-center justify-content-between mb-3">
         <h2 class="h3 mb-0">{{ $content[0]['data']['heading'] ?? __('Top offers') }}</h2>
         <a class="btn btn-link fw-normal p-0"
             href="{{ $content[0]['data']['view_link'] ?? '#' }}">{{ $content[0]['data']['view_text'] ?? __('View All') }}
             {!! $content[0]['data']['view_icon'] ?? '<i class="fi-arrow-long-right ms-2"></i>' !!}
         </a>
     </div>
     <div class="tns-carousel-wrapper tns-controls-outside-xxl tns-nav-outside tns-nav-outside-flush mx-n2">
         <div class="tns-carousel-inner row gx-4 mx-0 pb-4 pt-3"
             data-carousel-options='{"items": {{ count($flattenedProperties) }}, "responsive": {"0":{"items":1},"500":{"items":2},"768":{"items":3},"992":{"items":4}}}'>
             <!-- Item-->
             @each('partials.listing.search.grid', $flattenedProperties, 'property')
         </div>
     </div>
 </section>
