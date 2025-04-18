<?php

namespace App\DTOs;

class BlogDTO
{
    public function __construct(
        public int $userId,
        public string $title,
        public string $slug,
        public string $content,
        public int $categoryId,
        public array $tagIds,
        public bool $isPublished,
        public string $thumbnail
    ) {}

    public static function formRequest(array $data, int $userId): self
    {
        return new self(
            $userId,
            $data['title'],
            $data['slug'],
            $data['content'],
            $data['category_id'],
            $data['tag_ids'],
            $data['is_published'],
            $data['thumbnail'],
        );
    }

    public function toArray(): array
    {
        return [
            'user_id' => $this->userId,
            'title' => $this->title,
            'slug' => $this->slug,
            'content' => $this->content,
            'category_id' => $this->categoryId,
            'tag_ids' => $this->tagIds,
            'is_published' => $this->isPublished,
            'thumbnail' => $this->thumbnail,
        ];
    }
}
