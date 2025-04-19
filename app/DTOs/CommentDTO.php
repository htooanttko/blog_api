<?php

namespace App\DTOs;

class CommentDTO
{
    public function __construct(
        public int $userId,
        public string $blogId,
        public string $content
    ) {}

    public static function formRequest(array $data, int $userId): self
    {
        return new self(
            $userId,
            $data['blog_id'],
            $data['content']
        );
    }

    public function toArray(): array
    {
        return [
            'user_id' => $this->userId,
            'blog_id' => $this->blogId,
            'content' => $this->content
        ];
    }
}
