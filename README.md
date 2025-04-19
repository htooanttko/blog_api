# 📘 API Documentation

This API uses **Laravel Sanctum** for authentication. Most endpoints require an **Bearer token** to access. Authenticated requests must include the `Authorization` header:

---

## 🔐 Auth Endpoints

### `POST /api/auth/register`

Registers a new user.

**Request Body:**

```json
{
    "name": "hak",
    "email": "hak@example.com",
    "password": "your_password"
}
```

**Response:**

```json
{
    "status": 201,
    "success": true,
    "message": "Success",
    "data": {
        "user": {
            "name": "hak",
            "email": "hak@example.com",
            "updated_at": "timestamp",
            "created_at": "timestamp",
            "id": 1
        },
        "token": "your_generated_token"
    }
}
```

---

### `POST /api/auth/login`

Logs in a user.

**Request Body:**

```json
{
    "email": "hak@example.com",
    "password": "your_password"
}
```

**Response:**

```json
{
    "status": 200,
    "success": true,
    "message": "Success",
    "data": {
        "user": {
            "name": "hak",
            "email": "hak@example.com",
            "updated_at": "timestamp",
            "created_at": "timestamp",
            "id": 1
        },
        "token": "your_generated_token"
    }
}
```

---

### `POST /api/auth/logout`

#### 🔒 Requires Authentication

Logs out the authenticated user.

**Response:**

```json
{
    "status": 200,
    "success": true,
    "message": "Success",
    "data": "logout"
}
```

---

## 📝 Blog Endpoints

#### 🔒 All routes below require authentication.

### `GET /api/blogs`

Fetch all blog posts.

**Response:**

```json
{
    "status": 200,
    "success": true,
    "message": "Success",
    "data": [
        {
            "id": 2,
            "user_id": 1,
            "category_id": 1,
            "title": "test name and title",
            "slug": "test-slug",
            "content": "content about laravel",
            "is_published": 1,
            "created_at": "timestamp",
            "updated_at": "timestamp",
            "comments_count": 0,
            "likes_count": 0,
            "category": {
                "id": 1,
                "name": "PHP",
                "slug": "php"
            },
            "tags": [
                {
                    "id": 1,
                    "name": "Laravel",
                    "slug": "laravel",
                    "pivot": {
                        "blog_id": 2,
                        "tag_id": 1,
                        "tagged_by_user_id": 1
                    }
                }
            ],
            "author": {
                "id": 1,
                "name": "hak",
                "email": "hak@example.com"
            },
            "comments": [],
            "likes": []
        },
        ...
    ]
}
```

---

### `GET /api/blogs/{id}`

Fetch a specific blog post by ID.

**Response:**

```json
{
    "status": 200,
    "success": true,
    "message": "Success",
    "data": {
        "id": 1,
        "user_id": 1,
        "category_id": 1,
        "title": "test name and title",
        "slug": "test-slug-2",
        "content": "content about laravel",
        "is_published": 1,
        "created_at": "timestamp",
        "updated_at": "timestamp",
        "comments_count": 0,
        "likes_count": 0,
        "category": {
            "id": 1,
            "name": "PHP",
            "slug": "php"
        },
        "tags": [
            {
                "id": 1,
                "name": "Laravel",
                "slug": "laravel",
                "pivot": {
                    "blog_id": 1,
                    "tag_id": 1,
                    "tagged_by_user_id": 1
                }
            }
        ],
        "author": {
            "id": 1,
            "name": "hak",
            "email": "hak@example.com"
        },
        "comments": [],
        "likes": []
    }
}
```

---

### `POST /api/blogs`

Create a new blog post.

**Request Body:**

```json
{
    "title": "laravel",
    "slug": "test-slug",
    "content": "this is content about laravel",
    "category_id": 1,
    "tag_ids": [1],
    "is_published": true
}
```

**Response:**

```json
{
    "status": 200,
    "success": true,
    "message": "Success",
    "data": {
        "user_id": 1,
        "title": "laravel",
        "slug": "test-slug",
        "content": "this is content about laravel",
        "category_id": 1,
        "is_published": true,
        "updated_at": "timestamp",
        "created_at": "timestamp",
        "id": 3,
        "category": {
            "id": 1,
            "name": "PHP",
            "slug": "php"
        },
        "tags": [
            {
                "id": 1,
                "name": "Laravel",
                "slug": "laravel",
                "pivot": {
                    "blog_id": 3,
                    "tag_id": 1,
                    "tagged_by_user_id": 1
                }
            }
        ],
        "author": {
            "id": 1,
            "name": "hak",
            "email": "hak@example.com"
        }
    }
}
```

---

### `POST /api/blogs/comment`

Add a comment to a blog post.

**Request Body:**

```json
{
    "blog_id": 1,
    "content": "this blog is awesome!!!"
}
```

**Response:**

```json
{
    "status": 200,
    "success": true,
    "message": "Success",
    "data": {
        "user_id": 1,
        "blog_id": "1",
        "content": "this blog is awesome!!!",
        "updated_at": "timestamp",
        "created_at": "timestamp",
        "id": 1,
        "user": {
            "id": 1,
            "name": "hak"
        }
    }
}
```

---

### `POST /api/blogs/like`

Like a blog post.

**Request Body:**

```json
{
    "blog_id": 1
}
```

**Response:**

```json
{
    "status": 200,
    "success": true,
    "message": "Success",
    "data": "liked"
}
```

---

## 👤 User Endpoints

#### 🔒 All routes below require authentication.

### `GET /api/users`

Get a list of all users.

**Response:**

```json
{
    "status": 200,
    "success": true,
    "message": "Success",
    "data": [
        {
            "id": 1,
            "name": "hak",
            "email": "hak@example.com",
            "email_verified_at": null,
            "created_at": "timestamp",
            "updated_at": "timestamp",
            "blogs_count": 2,
            "comments_count": 0,
            "likes_count": 0,
            "blogs": [
                {
                    "id": 1,
                    "user_id": 1,
                    "category_id": 1,
                    "title": "test name and title",
                    "slug": "test-slug-2",
                    "category": {
                        "id": 1,
                        "name": "PHP",
                        "slug": "php"
                    },
                    "tags": [
                        {
                            "id": 1,
                            "name": "Laravel",
                            "slug": "laravel",
                            "pivot": {
                                "blog_id": 1,
                                "tag_id": 1,
                                "tagged_by_user_id": 1
                            }
                        }
                    ]
                },
                {
                    "id": 2,
                    "user_id": 1,
                    "category_id": 1,
                    "title": "test name and title",
                    "slug": "test-slug",
                    "category": {
                        "id": 1,
                        "name": "PHP",
                        "slug": "php"
                    },
                    "tags": [
                        {
                            "id": 1,
                            "name": "Laravel",
                            "slug": "laravel",
                            "pivot": {
                                "blog_id": 2,
                                "tag_id": 1,
                                "tagged_by_user_id": 1
                            }
                        }
                    ]
                }
            ],
            "comments": [],
            "likes": []
        }
    ]
}
```

---

### `GET /api/users/{id}`

Get details of a specific user by ID.

**Response:**

```json
{
    "status": 200,
    "success": true,
    "message": "Success",
    "data": {
        "id": 1,
        "name": "hak",
        "email": "hak@example.com",
        "email_verified_at": null,
        "created_at": "timestamp",
        "updated_at": "timestamp",
        "blogs_count": 3,
        "comments_count": 1,
        "likes_count": 1,
        "blogs": [
            {
                "id": 1,
                "user_id": 1,
                "category_id": 1,
                "title": "test name and title",
                "slug": "test-slug-2",
                "category": {
                    "id": 1,
                    "name": "PHP",
                    "slug": "php"
                },
                "tags": [
                    {
                        "id": 1,
                        "name": "Laravel",
                        "slug": "laravel",
                        "pivot": {
                            "blog_id": 1,
                            "tag_id": 1,
                            "tagged_by_user_id": 1
                        }
                    }
                ]
            },
            {
                "id": 2,
                "user_id": 1,
                "category_id": 1,
                "title": "test name and title",
                "slug": "test-slug",
                "category": {
                    "id": 1,
                    "name": "PHP",
                    "slug": "php"
                },
                "tags": [
                    {
                        "id": 1,
                        "name": "Laravel",
                        "slug": "laravel",
                        "pivot": {
                            "blog_id": 2,
                            "tag_id": 1,
                            "tagged_by_user_id": 1
                        }
                    }
                ]
            },
            {
                "id": 3,
                "user_id": 1,
                "category_id": 1,
                "title": "test laravel",
                "slug": "test-slug_again-and",
                "category": {
                    "id": 1,
                    "name": "PHP",
                    "slug": "php"
                },
                "tags": [
                    {
                        "id": 1,
                        "name": "Laravel",
                        "slug": "laravel",
                        "pivot": {
                            "blog_id": 3,
                            "tag_id": 1,
                            "tagged_by_user_id": 1
                        }
                    }
                ]
            }
        ],
        "comments": [
            {
                "id": 1,
                "blog_id": 1,
                "user_id": 1,
                "content": "this blog is awesome!!!",
                "created_at": "timestamp",
                "updated_at": "timestamp",
                "blog": {
                    "id": 1,
                    "title": "test name and title",
                    "slug": "test-slug-2"
                }
            }
        ],
        "likes": [
            {
                "id": 1,
                "user_id": 1,
                "blog_id": 1,
                "created_at": "timestamp",
                "updated_at": "timestamp",
                "blog": {
                    "id": 1,
                    "title": "test name and title",
                    "slug": "test-slug-2"
                }
            }
        ]
    }
}
```

---
