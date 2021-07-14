<?php


namespace Arafath57\BlogPackage\Models;


use Arafath57\BlogPackage\Database\Factories\FathPostCommentFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class FathPostComment extends Model
{
    use HasFactory;

    // Disable Laravel's mass assignment protection
    protected $guarded = [];

    public function author(): MorphTo
    {
        return $this->morphTo();
    }
    protected static function newFactory(): FathPostCommentFactory
    {
        return FathPostCommentFactory::new();
    }
    function post(): BelongsTo
    {
        return $this->belongsTo(FathPost::class,"fath_post_id");
    }
}