<?php

namespace App\Repositories;

use App\Models\Blog;
use App\Repositories\Interfaces\BlogRepositoryInterface;

class BlogRepository implements BlogRepositoryInterface
{
    public function getAll()
    {
        return Blog::with([
            'category:id,name,slug',
            'tags:id,name,slug',
            'author:id,name,email',
            'comments.user:id,name'
        ])
            ->withCount('comments')
            ->latest()
            ->get();
    }

    public function findById(int $id): ?Blog
    {
        return Blog::with([
            'category:id,name,slug',
            'tags:id,name,slug',
            'author:id,name,email',
            'comments.user:id,name'
        ])
            ->withCount('comments')
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
}
