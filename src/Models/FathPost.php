<?php

namespace Arafath57\BlogPackage\Models;

use Arafath57\BlogPackage\Database\Factories\FathPostFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphTo;


class FathPost extends Model
{
    use HasFactory;
    const PUBLISHED="published";
    const DRAFT="draft";
    // Disable Laravel's mass assignment protection
    protected $guarded = [];

    public function author(): MorphTo
    {
        return $this->morphTo();
    }
    protected static function newFactory(): FathPostFactory
    {
        return FathPostFactory::new();
    }
    public function images(): HasMany
    {
        return $this->hasMany(FathPost::class);
    }
    public function comments(): HasMany
    {
        return $this->hasMany(FathPostComment::class);
    }
    public function category(): BelongsTo
    {
        return $this->belongsTo(FathPostCategory::class,"fath_post_category_id");
    }
}