 <div class="mb-md-5 mb-4" id="comments">
     <h3 class="mb-4 pb-2">{{ __(':count comments', ['count' => $post->comments->count()]) }}</h3>
     @foreach ($comments as $comment)
         <!-- Comment-->
         @include('partials.comments.comment', [
             'model' => $post,
         ])
     @endforeach
     {{ $comments->appends(request()->query(), '[*]')->links() }}
 </div>
