<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function index()
    {
        $term = request()->query('s');
        $category = request()->query('category');
        $sort = request()->query('sort', 'desc');
        $featureds = Post::query()
            ->when($term, function ($query) use ($term) {
                return $query->where(function ($query) use ($term) {
                    $query->whereFullText('title', $term)
                        ->orWhereFullText('content', $term);
                });
            })
            ->when($category, function ($query) use ($category) {
                return $query->whereHas('categories', function ($builder) use ($category) {
                    $builder->where('categories.id', $category);
                });
            })
            ->when($sort, function ($query) use ($sort) {
                return $query->orderBy('created_at', $sort);
            })
            ->featured()
            ->limit(4)
            ->get();
        $posts = Post::query()
            ->when($term, function ($query) use ($term) {
                return $query->where(function ($query) use ($term) {
                    $query->whereFullText('title', $term)
                        ->orWhereFullText('content', $term);
                });
            })
            ->when($category, function ($query) use ($category) {
                return $query->whereHas('categories', function ($builder) use ($category) {
                    $builder->where('categories.id', $category);
                });
            })
            ->when($sort, function ($query) use ($sort) {
                return $query->orderBy('created_at', $sort);
            })
            ->notfeatured()
            ->paginate(10);
        $categories = Category::PostType()->get();

        return view('blog', compact('featureds', 'posts', 'categories'));
    }

    public function show(Post $post)
    {
        $comments = $post->commentsParent()->paginate(5, ['*'], 'comments');

        return view('single_blog', compact('post', 'comments'));
    }

    public function comment(Request $request, Post $post, $parent = null)
    {
        $request->validate([
            'comment' => 'required_if:reply,|min:3',
            'reply' => 'required_if:comment,|min:3'
        ]);

        $comment = $post->comment($request->comment ?? $request->reply);

        if ($parent) {
            $comment->parent_id = $parent;
            $comment->save();
        }

        return redirect(url()->previous() . '#comment-' . $comment->id)->with(['status' => __('You commented on this post')]);
    }

    public function deleteComment($comment)
    {
        $comment = Comment::findOrFail($comment);

        $this->recursiveDelete($comment);

        return redirect(url()->previous() . '#comments')->with(['status' => __('You deleted a comment')]);
    }

    public function editComment(Request $request, $comment)
    {
        $request->validate([
            'comment_update' => 'required|min:3'
        ]);
        $comment = Comment::findOrFail($comment);
        $comment->comment = $request->comment_update;
        $comment->save();

        return redirect(url()->previous() . '#comment-' . $comment->id)->with(['status' => __('You have updated a comment')]);
    }

    public function recursiveDelete($comment)
    {
        if (!is_null($comment->children)) {
            foreach ($comment->children as $child) {
                $this->recursiveDelete($child);
            }
        }

        $comment->delete();
    }
}
