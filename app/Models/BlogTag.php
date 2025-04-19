<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class BlogTag extends Pivot
{
    protected $table = 'blog_tags';

    protected $fillable = [
        'blog_id',
        'tag_id',
        'tagged_by_user_id',
    ];

    protected $hidden = [
        'created_at',
        'updated_at'
    ];

    public function taggedBy()
    {
        return $this->belongsTo(User::class, 'tagged_by_user_id');
    }
}
