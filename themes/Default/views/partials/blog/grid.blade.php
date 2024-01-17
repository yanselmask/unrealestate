<article class="col pb-md-1 pb-2">
    <a class="d-block position-relative mb-3" href="{{ route('blog.show', $post) }}">
        @if (is_new($post->created_at))
            <span class="badge bg-info position-absolute fs-sm end-0 top-0 m-3">{{ __('New') }}</span>
        @endif
        @if ($post->is_sponsored)
            <span class="badge bg-success position-absolute m-3">{{ __('Sponsored') }}</span>
        @endif
        <img class="d-block rounded-3" src="{{ $post->image_url }}" alt="{{ $post->title }}">
    </a>
    <a class="fs-sm text-uppercase text-decoration-none"
        href="#">{{ $post->categories->pluck('title')->join(', ') }}</a>
    <h3 class="h5 mb-2 pt-1">
        <a class="nav-link" href="{{ route('blog.show', $post) }}">
            {{ $post->title }}
        </a>
    </h3>
    <p class="mb-3">
        {{ str_limit(strip_tags($post->content)) }}
    </p>
    <a class="d-flex align-items-center text-decoration-none" href="#">
        <img class="rounded-circle" src="{{ $post->author_image }}" width="48" alt="{{ $post->author_name }}">
        <div class="ps-2">
            <h6 class="fs-base text-nav lh-base mb-1">{{ $post->author_name }}</h6>
            <div class="d-flex text-body fs-sm">
                <span class="me-2 pe-1">
                    <i
                        class="fi-calendar-alt mt-n1 me-1 align-middle opacity-70"></i>{{ site_date($post->created_at) }}
                </span>
                <span>
                    <i
                        class="fi-chat-circle mt-n1 me-1 align-middle opacity-70"></i>{{ __(':count comments', ['count' => $post->comments->count()]) }}</span>
            </div>
        </div>
    </a>
</article>
