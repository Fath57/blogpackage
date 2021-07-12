<?php

namespace Arafath57\BlogPackage\Traits;

use Arafath57\BlogPackage\Models\Post;

trait HasPosts
{
    public function posts()
    {
        return $this->morphMany(Post::class, 'author');
    }
}
