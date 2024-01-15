<div class="card py-md-4 py-3 shadow-sm" x-data="{ expanded: false }">
    <div class="card-body col-lg-8 col-md-10 px-md-0 mx-auto px-4">
        <h3 class="pb-sm-2 mb-4">{{ __('Leave your comment') }}</h3>
        @auth
            <form class="row gy-md-4 gy-3" action="{{ route('blog.comment', $post) }}" method="POST">
                @csrf
                <div class="col-12">
                    <label class="form-label" for="comment-text">{{ __('Comment') }}</label>
                    <textarea name="comment" class="form-control form-control-lg @error('comment') is-invalid @enderror" id="comment-text"
                        rows="4" placeholder="Type comment here" required>{{ old('comment') }}</textarea>
                    @error('comment')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-12 py-2">
                    <button class="btn btn-lg btn-primary" type="submit">{{ __('Post comment') }}</button>
                </div>
            </form>
        @else
            <a href="{{ route('login') }}" class="btn btn-lg btn-primary">{{ __('Login') }}</a>
        @endauth
    </div>
</div>
