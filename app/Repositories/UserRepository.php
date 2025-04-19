<?php

namespace App\Repositories;

use App\Models\User;
use App\Repositories\Interfaces\UserRepositoryInterface;

class UserRepository implements UserRepositoryInterface
{
    public function getAll()
    {
        return User::with([
            'blogs:id,user_id,category_id,title,slug',
            'blogs.category:id,name,slug',
            'blogs.tags:id,name,slug',
            'comments.blog:id,title,slug',
            'likes.blog:id,title,slug'
        ])
            ->withCount(['blogs', 'comments', 'likes'])
            ->latest()
            ->get();
    }

    public function findById(int $id): ?User
    {
        return User::with([
            'blogs:id,user_id,category_id,title,slug',
            'blogs.category:id,name,slug',
            'blogs.tags:id,name,slug',
            'comments.blog:id,title,slug',
            'likes.blog:id,title,slug'
        ])
            ->withCount(['blogs', 'comments', 'likes'])
            ->findOrFail($id);
    }
}
