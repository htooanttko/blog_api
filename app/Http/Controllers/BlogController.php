<?php

namespace App\Http\Controllers;

use App\DTOs\BlogDTO;
use App\DTOs\CommentDTO;
use App\DTOs\LikeDTO;
use App\Helpers\ResponseHelper;
use App\Http\Requests\BlogRequest;
use App\Http\Requests\CommentRequest;
use App\Http\Requests\LikeRequest;
use App\Services\BlogService;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    private BlogService $blogService;

    public function __construct(BlogService $blogService)
    {
        $this->blogService = $blogService;
    }

    public function index()
    {
        $blogs = $this->blogService->getBlogs();
        return ResponseHelper::success($blogs);
    }

    public function show($id)
    {
        $blog = $this->blogService->getBlogById($id);
        return $blog ? ResponseHelper::success($blog) : ResponseHelper::error('Blog not found', 404);
    }

    public function store(BlogRequest $request)
    {
        $validated = $request->validated();
        $userId = $request->user()->id;

        $blogDTO = BlogDTO::formRequest($validated, $userId);
        $blog = $this->blogService->createBlog($blogDTO);

        return $blog ? ResponseHelper::success($blog) : ResponseHelper::error(status: 500, errors: $blog);
    }

    public function comment(CommentRequest $request)
    {
        $validated = $request->validated();
        $userId = $request->user()->id;

        $commentDTO = CommentDTO::formRequest($validated, $userId);
        $comment = $this->blogService->createCommentBlog($commentDTO);

        return $comment ? ResponseHelper::success($comment) : ResponseHelper::error(status: 500, errors: $comment);
    }

    public function like(LikeRequest $request)
    {
        $validated = $request->validated();
        $userId = $request->user()->id;

        $likeDTO = LikeDTO::formRequest($validated, $userId);
        $like = $this->blogService->toggleLikeBlog($likeDTO);

        return $like ? ResponseHelper::success($like) : ResponseHelper::error(status: 500, errors: $like);
    }
}
