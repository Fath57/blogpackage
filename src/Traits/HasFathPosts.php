<?php

namespace Arafath57\BlogPackage\Traits;

use Arafath57\BlogPackage\Models\FathPost;

trait HasFathPosts
{
    public function posts()
    {
        return $this->morphMany(FathPost::class, 'author');
    }
}
