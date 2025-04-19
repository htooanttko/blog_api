<?php

namespace App\Services;

use App\DTOs\BlogDTO;
use App\DTOs\CommentDTO;
use App\DTOs\LikeDTO;
use App\Repositories\Interfaces\BlogRepositoryInterface;

class BlogService
{
    private BlogRepositoryInterface $blogRepository;

    public function __construct(BlogRepositoryInterface $blogRepository)
    {
        $this->blogRepository = $blogRepository;
    }

    public function getBlogs()
    {
        return $this->blogRepository->getAll();
    }

    public function getBlogById(int $id)
    {
        return $this->blogRepository->findById($id);
    }

    public function createBlog(BlogDTO $blogDTO)
    {
        return $this->blogRepository->create($blogDTO->toArray());
    }

    public function createCommentBlog(CommentDTO $commentDTO)
    {
        return $this->blogRepository->commentBlog($commentDTO->toArray());
    }

    public function toggleLikeBlog(LikeDTO $likeDTO)
    {
        return $this->blogRepository->likeBlog($likeDTO->blogId, $likeDTO->userId);
    }
}
