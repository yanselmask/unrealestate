<?php

namespace App\Models;

use BeyondCode\Comments\Comment as CommentsComment;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends CommentsComment
{
    use HasFactory;


    public function children()
    {
        return $this->hasMany(Comment::class, 'parent_id')->orderByDesc('created_at');
    }

    public function parent()
    {
        return $this->belongsTo(Comment::class, 'parent_id')->orderByDesc('created_at');
    }

    public function scopeIsParent($sql)
    {
        return $sql->whereNull('parent_id');
    }

    public function scopeIsChild($sql)
    {
        return $sql->whereNotNull('parent_id');
    }
}
