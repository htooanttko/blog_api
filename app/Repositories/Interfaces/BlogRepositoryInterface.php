<?php

namespace App\Repositories\Interfaces;

use App\Models\Blog;
use App\Models\Comment;

interface BlogRepositoryInterface
{
    public function getAll();
    public function findById(int $id): ?Blog;
    public function create(array $data): Blog;
    public function commentBlog(array $data): Comment;
    public function likeBlog(int $blogId, int $userId): string;
}
