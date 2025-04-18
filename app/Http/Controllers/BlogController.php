<?php

namespace App\Http\Controllers;

use App\DTOs\BlogDTO;
use App\Helpers\ResponseHelper;
use App\Http\Requests\BlogRequest;
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
        $userId = auth()->id;

        $blogDTO = BlogDTO::formRequest($validated, $userId);
        $blog = $this->blogService->createBlog($blogDTO);

        return $blog ? ResponseHelper::success($blog) : ResponseHelper::error(status: 500, errors: $blog);
    }
}
