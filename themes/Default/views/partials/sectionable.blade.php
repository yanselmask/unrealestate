 @foreach ($sections as $section)
     @if ($section->key == 'hero')
         @include('sections.hero', [
             'content' => $section->content,
         ])
     @endif
     @if ($section->key == 'category')
         @include('sections.categories', [
             'content' => $section->content,
         ])
     @endif
     @if ($section->key == 'service')
         @include('sections.service', [
             'content' => $section->content,
         ])
     @endif
     @if ($section->key == 'calculator')
         @include('sections.calculator', [
             'content' => $section->content,
         ])
     @endif
     @if ($section->key == 'partner')
         @include('sections.partner', [
             'content' => $section->content,
         ])
     @endif
     @if ($section->key == 'agent')
         @include('sections.agent', [
             'content' => $section->content,
         ])
     @endif
     @if ($section->key == 'offer')
         @include('sections.offer', [
             'content' => $section->content,
         ])
     @endif
     @if ($section->key == 'contact')
         @include('sections.contact', [
             'content' => $section->content,
         ])
     @endif
     @if ($section->key == 'info_contact')
         @include('sections.info_contact', [
             'content' => $section->content,
         ])
     @endif
     @if ($section->key == 'city')
         @include('sections.city', [
             'content' => $section->content,
         ])
     @endif
 @endforeach
