<x-master-layout>
    <div class="mb-md-4 container mt-5 py-5">
        <!-- Breadcrumb-->
        @include('partials.breadcrumb', [
            'before' => [
                'Home' => route('home'),
                'Blog' => route('blog.index'),
            ],
            'active' => $post->title,
        ])
        <!-- Post title + meta-->
        <a class="nav-link d-inline-block fw-normal text-uppercase mb-2 px-0"
            href="#">{{ $post->categories->pluck('title')->join(', ') }}</a>
        <h1 class="h2 mb-4">{{ $post->title }}</h1>
        <div class="mb-4 pb-1">
            <ul class="list-unstyled d-flex text-nowrap mb-0 flex-wrap">
                <li class="me-3"><i class="fi-calendar-alt mt-n1 me-2 opacity-60"></i>{{ site_date($post->created_at) }}
                </li>
                <li class="border-end me-3"></li>
                <li class="me-3">
                    <i
                        class="fi-clock mt-n1 me-2 opacity-60"></i>{{ __(':time read min', ['time' => time_read($post->content)]) }}
                </li>
                <li class="border-end me-3"></li>
                <li class="me-3"><a class="nav-link-muted" href="#comments" data-scroll><i
                            class="fi-chat-circle mt-n1 me-2 opacity-60"></i>{{ __(':count comments', ['count' => $post->comments->count()]) }}</a>
                </li>
            </ul>
        </div>
        <!-- Post content-->
        <div class="pb-md-3 mb-4">
            <img class="rounded-3" src="{{ $post->image_single }}" alt="{{ $post->title }}">
        </div>
        <div class="row">
            <div class="col-lg-2 col-md-1 mb-md-0 mt-md-n5 mb-4">
                <!-- Sharing-->
                <div class="sticky-top py-md-5 mt-md-5">
                    <div class="d-flex flex-md-column align-items-center mt-md-4 pt-md-5 my-2">
                        <div class="d-md-none fw-bold text-nowrap me-2 pe-1">{{ __('Share') }}:</div>
                        <a class="btn btn-icon btn-light-primary btn-xs rounded-circle mb-md-2 me-md-0 me-2 shadow-sm"
                            href="https://www.facebook.com/sharer/sharer.php?u={{ request()->url() }}"
                            data-bs-toggle="tooltip" title="{{ __('Share with Facebook') }}" target="_blank">
                            <i class="fi-facebook"></i>
                        </a>
                        <a class="btn btn-icon btn-light-primary btn-xs rounded-circle mb-md-2 me-md-0 me-2 shadow-sm"
                            href="https://twitter.com/intent/tweet?url={{ request()->url() }}&text={{ $post->title }}"
                            data-bs-toggle="tooltip" title="{{ __('Share with Twitter') }}" target="_blank">
                            <i class="fi-twitter"></i>
                        </a>
                        <a class="btn btn-icon btn-light-primary btn-xs rounded-circle mb-md-2 me-md-0 me-2 shadow-sm"
                            href="https://www.linkedin.com/shareArticle?url={{ request()->url() }}&title={{ $post->title }}&summary={{ str_limit($post->content) }}&source={{ setting('site_url') }}"
                            data-bs-toggle="tooltip" title="{{ __('Share with LinkedIn') }}" target="_blank">
                            <i class="fi-linkedin"></i>
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-lg-8 col-md-10">
                <!-- Author-->
                <div class="pb-md-3 mb-4">
                    <a class="d-flex align-items-center text-body text-decoration-none" href="#">
                        <img class="rounded-circle" src="{{ $post->author_image }}" width="80"
                            alt="{{ $post->author_name }}">
                        <div class="ps-3">
                            <h2 class="h6 mb-1">{{ $post->author_name }}</h2>
                            <span class="fs-sm">{{ $post->author_bio }}</span>
                        </div>
                    </a>
                </div>
                <!-- Post content-->
                {!! $post->content !!}
                <!-- Post tags-->
                @if ($post->tags->count() > 0)
                    <div class="d-flex align-items-center my-md-5 py-md-4 border-top my-4 py-3">
                        <div class="fw-bold text-nowrap mb-2 me-2 pe-1">{{ __('Tags') }}:</div>
                        <div class="d-flex flex-wrap">
                            @foreach ($post->tags as $tag)
                                <a class="btn btn-xs btn-outline-secondary rounded-pill fs-sm fw-normal mb-2 me-2"
                                    href="#">{{ $tag->name }}</a>
                            @endforeach
                        </div>
                    </div>
                @endif
                @if ($post->allowed_comment || $post->comments->count() > 0)
                    <!-- Comments-->
                    @include('partials.comments.comments')
                @endif
            </div>
        </div>
        @if ($post->allowed_comment)
            <!-- Comment form-->
            @include('partials.comments.form')
        @endif
    </div>
</x-master-layout>
