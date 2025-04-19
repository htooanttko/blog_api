<?php

namespace App\Repositories;

use App\Models\Blog;
use App\Models\Comment;
use App\Models\Like;
use App\Repositories\Interfaces\BlogRepositoryInterface;

class BlogRepository implements BlogRepositoryInterface
{
    public function getAll()
    {
        return Blog::with([
            'category:id,name,slug',
            'tags:id,name,slug',
            'author:id,name,email',
            'comments.user:id,name',
            'likes.user:id,name'
        ])
            ->withCount(['comments', 'likes'])
            ->latest()
            ->get();
    }

    public function findById(int $id): ?Blog
    {
        return Blog::with([
            'category:id,name,slug',
            'tags:id,name,slug',
            'author:id,name,email',
            'comments.user:id,name',
            'likes.user:id,name'
        ])
            ->withCount(['comments', 'likes'])
            ->findOrFail($id);
    }

    public function create(array $data): Blog
    {
        $blog = Blog::create($data);
        if (!empty($data['tag_ids'])) {
            $tagData = [];
            foreach ($data['tag_ids'] as $tagId) {
                $tagData[$tagId] = ['tagged_by_user_id' => $data['user_id']];
            }
            $blog->tags()->attach($tagData);
        }

        return $blog->load([
            'category:id,name,slug',
            'tags:id,name,slug',
            'author:id,name,email',
        ]);
    }

    public function commentBlog(array $data): Comment
    {
        $comment = Comment::create($data);

        return $comment->load('user:id,name');
    }

    public function likeBlog(int $blogId, int $userId): string
    {
        $like = Like::where('blog_id', $blogId)
            ->where('user_id', $userId)
            ->first();

        if ($like) {
            $like->delete();
            return 'unliked';
        }

        Like::create([
            'blog_id' => $blogId,
            'user_id' => $userId
        ]);

        return 'liked';
    }
}
