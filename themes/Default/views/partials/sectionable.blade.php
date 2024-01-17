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
     @if ($section->key == 'about')
         @include('sections.about', [
             'content' => $section->content,
         ])
     @endif
     @if ($section->key == 'choose')
         @include('sections.choose', [
             'content' => $section->content,
         ])
     @endif
     @if ($section->key == 'works')
         @include('sections.works', [
             'content' => $section->content,
         ])
     @endif
     @if ($section->key == 'team')
         @include('sections.team', [
             'content' => $section->content,
         ])
     @endif
     @if ($section->key == 'testimonial')
         @include('sections.testimonial', [
             'content' => $section->content,
         ])
     @endif
     @if ($section->key == 'jumbotron')
         @include('sections.jumbotron', [
             'content' => $section->content,
         ])
     @endif
     @if ($section->key == 'accordion')
         @include('sections.accordion', [
             'content' => $section->content,
         ])
     @endif
 @endforeach
