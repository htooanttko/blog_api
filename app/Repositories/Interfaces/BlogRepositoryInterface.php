<?php

namespace App\Repositories\Interfaces;

use App\Models\Blog;

interface BlogRepositoryInterface
{
    public function getAll();
    public function findById(int $id): ?Blog;
    public function create(array $data): Blog;
}
