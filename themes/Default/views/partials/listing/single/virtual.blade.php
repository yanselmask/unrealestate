 @if ($property->virtual_link)
     <div class="pb-md-3 mb-4">
         <h3 class="h4">{{ __('Virtual Tour') }}</h3>
         <iframe src="{{ $property->virtual_link }}" frameborder="0" style="border-radius: 20px" width="951"
             height="535"></iframe>
     </div>
 @endif
