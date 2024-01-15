 <div id="comment-{{ $comment->id }}"
     class="@if (is_null($comment->parent_id)) border-bottom mb-4 pb-4 @else border-start ms-4 mt-4 border-4 ps-4 @endif">
     <p>{{ $comment->comment }}</p>
     <div class="d-flex justify-content-between align-items-center">
         <div class="d-flex align-items-center pe-2">
             <img class="rounded-circle me-1" src="{{ $comment->commentator->profile_photo_url }}"
                 style="width: 48px;height:48px;object-fit:cover;" alt="{{ $comment->commentator->fullname }}">
             <div class="ps-2">
                 <h6 class="fs-base mb-0">
                     {{ $comment->commentator->fullname }}
                     @if ($comment->user_id === $model->user_id)
                         <span class="badge bg-info rounded-pill fs-xs ms-2">{{ __('Author') }}</span>
                     @endif
                 </h6>
                 <span class="text-muted fs-sm">{{ site_date($comment->created_at) }}</span>
             </div>
         </div>
         <div class="d-flex">
             @auth
                 @if ($loop->depth <= 1)
                     <button class="btn btn-link btn-sm" type="button" data-bs-toggle="modal"
                         data-bs-target="#modalReplyComment-{{ $comment->id }}">
                         <i class="fi-reply fs-lg me-2"></i>
                         <span class="fw-normal">{{ __('Reply') }}</span>
                     </button>
                     <div class="modal" id="modalReplyComment-{{ $comment->id }}" tabindex="-1" aria-modal="true"
                         role="dialog">
                         <div class="modal-dialog" role="document" x-data="{ reply: @js(old('reply', '')) }">
                             <form action="{{ route('blog.comment', [$model, $comment->id]) }}" method="POST">
                                 @csrf
                                 <div class="modal-content">
                                     <div class="modal-header">
                                         <h4 class="modal-title">
                                             {{ __('Responding to a comment') }}
                                         </h4>
                                         <button class="btn-close" type="button" data-bs-dismiss="modal"
                                             aria-label="Close"></button>
                                     </div>
                                     <div class="modal-body">
                                         <div class="mb-3">
                                             <label for="comment_reply">{{ __('Leave your answer') }}</label>
                                             <textarea x-model="reply" placeholder="{{ __('Write your comment') }}" name="reply"
                                                 class="form-control @error('reply') is-invalid @enderror" id="comment_reply"></textarea>
                                             @error('reply')
                                                 <div class="invalid-feedback">{{ $message }}</div>
                                             @enderror
                                         </div>
                                     </div>
                                     <div class="modal-footer">
                                         <button class="btn btn-secondary btn-sm" type="button"
                                             data-bs-dismiss="modal">{{ __('Close') }}</button>
                                         <button x-bind:disabled="reply == '' || reply.length < 3"
                                             class="btn btn-primary btn-shadow btn-sm"
                                             type="submit">{{ __('Leave reply') }}</button>
                                     </div>
                                 </div>
                             </form>
                         </div>
                     </div>
                 @endif
                 @if ($comment->user_id === auth()->user()->id)
                     <button class="btn btn-link btn-sm text-primary" type="button" data-bs-toggle="modal"
                         data-bs-target="#modalEditComment-{{ $comment->id }}">
                         <i class="fi-pencil fs-lg me-2"></i>
                         <span class="fw-normal">{{ __('Edit') }}</span>
                     </button>
                     <div class="modal" id="modalEditComment-{{ $comment->id }}" tabindex="-1" aria-modal="true"
                         role="dialog">
                         <div class="modal-dialog" role="document" x-data="{ comment: @js(old('comment_update', $comment->comment)) }">
                             <form action="{{ route('blog.comment.edit', $comment) }}" method="POST">
                                 @csrf
                                 @method('PATCH')
                                 <div class="modal-content">
                                     <div class="modal-header">
                                         <h4 class="modal-title">
                                             {{ __('Updating comment') }}
                                         </h4>
                                         <button class="btn-close" type="button" data-bs-dismiss="modal"
                                             aria-label="Close"></button>
                                     </div>
                                     <div class="modal-body">
                                         <div class="mb-3">
                                             <label for="comment_update">{{ __('Update your comment') }}</label>
                                             <textarea x-model="comment" placeholder="{{ __('Write your comment') }}" name="comment_update"
                                                 class="form-control @error('comment_update') is-invalid @enderror" id="comment_update"></textarea>
                                             @error('comment_update')
                                                 <div class="invalid-feedback">{{ $message }}</div>
                                             @enderror
                                         </div>
                                     </div>
                                     <div class="modal-footer">
                                         <button class="btn btn-secondary btn-sm" type="button"
                                             data-bs-dismiss="modal">{{ __('Close') }}</button>
                                         <button x-bind:disabled="comment == '' || comment.length < 3"
                                             class="btn btn-primary btn-shadow btn-sm"
                                             type="submit">{{ __('Update comment') }}</button>
                                     </div>
                                 </div>
                             </form>
                         </div>
                     </div>
                     <button class="btn btn-link btn-sm text-danger" type="button" data-bs-toggle="modal"
                         data-bs-target="#modalDeleteComment-{{ $comment->id }}">
                         <i class="fi-trash fs-lg me-2"></i>
                         <span class="fw-normal">{{ __('Delete') }}</span>
                     </button>
                     <!-- Delete Comment -->
                     <div class="modal" id="modalDeleteComment-{{ $comment->id }}" tabindex="-1" aria-modal="true"
                         role="dialog">
                         <div class="modal-dialog" role="document">
                             <form action="{{ route('blog.comment.delete', $comment) }}" method="POST">
                                 @csrf
                                 @method('DELETE')
                                 <div class="modal-content">
                                     <div class="modal-header">
                                         <h4 class="modal-title">
                                             {{ __('Are you sure you want to delete this post?') }}
                                         </h4>
                                         <button class="btn-close" type="button" data-bs-dismiss="modal"
                                             aria-label="Close"></button>
                                     </div>
                                     <div class="modal-body">
                                         <p>{{ __('This action can not be undone') }}</p>
                                     </div>
                                     <div class="modal-footer">
                                         <button class="btn btn-secondary btn-sm" type="button"
                                             data-bs-dismiss="modal">{{ __('Close') }}</button>
                                         <button class="btn btn-danger btn-shadow btn-sm"
                                             type="submit">{{ __('Delete comment') }}</button>
                                     </div>
                                 </div>
                             </form>
                         </div>
                     </div>
                 @endif
             @endauth
         </div>
     </div>
     <!-- Reply to comment-->
     @php
         $children = $comment->children()->paginate(3, ['*'], 'children_' . $comment->id);
     @endphp
     @foreach ($children as $child)
         @include('partials.comments.comment', [
             'comment' => $child,
         ])
     @endforeach
     @if ($children->total() > 0)
         {{ $children->links() }}
     @endif
 </div>
