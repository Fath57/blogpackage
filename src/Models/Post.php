<?php

namespace Arafath57\BlogPackage\Models;

use Arafath57\BlogPackage\Database\Factories\PostFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Post extends Model
{
    use HasFactory;

    // Disable Laravel's mass assignment protection
    protected $guarded = [];

    public function author(): MorphTo
    {
        return $this->morphTo();
    }
    protected static function newFactory(): PostFactory
    {
        return PostFactory::new();
    }
}