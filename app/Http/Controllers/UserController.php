<?php

namespace App\Http\Controllers;

use App\Helpers\ResponseHelper;
use App\Services\UserService;
use Illuminate\Http\Request;

class UserController extends Controller
{
    private UserService $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function index()
    {
        $blogs = $this->userService->getUsers();
        return ResponseHelper::success($blogs);
    }

    public function show($id)
    {
        $blog = $this->userService->getUserById($id);
        return $blog ? ResponseHelper::success($blog) : ResponseHelper::error('User not found', 404);
    }
}
