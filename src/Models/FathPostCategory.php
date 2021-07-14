<?php


namespace Arafath57\BlogPackage\Models;


use Arafath57\BlogPackage\Database\Factories\FathPostCategoryFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class FathPostCategory extends Model
{
    use HasFactory;
    // Disable Laravel's mass assignment protection
    protected $guarded = [];
    protected static function newFactory(): FathPostCategoryFactory
    {
        return FathPostCategoryFactory::new();
    }

    public function posts(): HasMany
    {
        return $this->hasMany(FathPost::class);
    }
}