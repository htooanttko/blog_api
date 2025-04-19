<?php

namespace App\DTOs;

class LikeDTO
{
    public function __construct(
        public int $userId,
        public string $blogId,
    ) {}

    public static function formRequest(array $data, int $userId): self
    {
        return new self(
            $userId,
            $data['blog_id'],
        );
    }

    public function toArray(): array
    {
        return [
            'user_id' => $this->userId,
            'blog_id' => $this->blogId,
        ];
    }
}
