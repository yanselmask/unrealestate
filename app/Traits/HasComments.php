<?php

namespace App\Traits;

use BeyondCode\Comments\Traits\HasComments as TraitsHasComments;

trait HasComments
{
    use  TraitsHasComments;

    /**
     * Return all comments for this model.
     *
     * @return MorphMany
     */
    public function commentsParent()
    {
        return $this->morphMany(config('comments.comment_class'), 'commentable')->IsParent()->orderByDesc('created_at');
    }
}
