<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    protected $fillable = [
        'name',
        'slug',
    ];

    public function blogs()
    {
        return $this->belongsToMany(Blog::class, 'blog_tags')
            ->using(BlogTag::class)
            ->withPivot('tagged_by_user_id')
            ->withTimestamps();
    }
}
