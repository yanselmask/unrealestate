 @if ($property->video_link)
     <div class="pb-md-3 mb-4">
         <h3 class="h4">{{ __('Video') }}</h3>
         <iframe width="951" height="535" style="border-radius: 20px;"
             src="https://www.youtube.com/embed/{{ $property->video_link }}"
             title="Many-to-many relationships | Filament 3 Tutorial for Beginners EP8" frameborder="0"
             allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
             allowfullscreen></iframe>
     </div>
 @endif
