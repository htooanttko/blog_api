<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    public function blogs()
    {
        return $this->belongsToMany(Blog::class)
            ->using(BlogTag::class)
            ->withPivot('tagged_by_user_id')
            ->withTimestamps();
    }
}
