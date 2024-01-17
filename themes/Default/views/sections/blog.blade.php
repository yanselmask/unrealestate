 @php
     $articles = App\Models\Post::with(['user', 'categories'])
         ->withCount('comments')
         ->published()
         ->latest()
         ->limit($content[0]['data']['limit'] ?? 3)
         ->get();
 @endphp
 <section class="pb-lg-5 container mb-5">
     <div class="d-sm-flex align-items-center justify-content-between mb-4 pb-2">
         <h2 class="h3 mb-sm-0">{{ $content[0]['data']['heading'] }}</h2>
     </div>
     <!-- Carousel-->
     <div class="tns-carousel-wrapper tns-nav-outside">
         <div class="tns-carousel-inner d-block"
             data-carousel-options="{&quot;controls&quot;: false, &quot;gutter&quot;: 24, &quot;autoHeight&quot;: true, &quot;responsive&quot;: {&quot;0&quot;:{&quot;items&quot;:1,&quot;nav&quot;:true},&quot;500&quot;:{&quot;items&quot;:2},&quot;850&quot;:{&quot;items&quot;:3},&quot;1200&quot;:{&quot;items&quot;:3}}}">
             @forelse ($articles as $article)
                 <!-- Item-->
                 <article>
                     <a class="d-block mb-3" href="{{ route('blog.show', $article) }}">
                         <img class="rounded-3" src="{{ $article->image_url }}" alt="{{ $article->title }}"></a>
                     <a class="fs-xs text-uppercase text-decoration-none" href="#">
                         {{ $article->categories->pluck('title')->join(', ') }}
                     </a>
                     <h3 class="fs-base pt-1">
                         <a class="nav-link" href="{{ route('blog.show', $article) }}">
                             {{ $article->title }}
                         </a>
                     </h3><a class="d-flex align-items-center text-decoration-none" href="#">
                         <img class="rounded-circle" src="{{ $article->user->profile_photo_url }}" width="44"
                             alt="{{ $article->user->fullname }}">
                         <div class="ps-2">
                             <h6 class="fs-sm text-nav lh-base mb-1">{{ $article->user->fullname }}</h6>
                             <div class="d-flex text-body fs-xs">
                                 <span class="me-2 pe-1">
                                     <i
                                         class="fi-calendar-alt mt-n1 me-1 align-middle opacity-70"></i>{{ site_date($article->created_at) }}
                                 </span>
                                 <span>
                                     <i
                                         class="fi-chat-circle mt-n1 me-1 align-middle opacity-70"></i>{{ __(':count comments', ['count' => $article->comments_count]) }}
                                 </span>
                             </div>
                         </div>
                     </a>
                 </article>
             @empty
                 @include('partials.not_found')
             @endforelse
         </div>
     </div>
 </section>
