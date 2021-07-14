<?php


namespace Arafath57\BlogPackage\Models;


use Arafath57\BlogPackage\Database\Factories\FathPostImageFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FathPostImage extends Model
{
    use HasFactory;


    // Disable Laravel's mass assignment protection
    protected $guarded = [];

    public static function newFactory(): FathPostImageFactory
    {
        return  FathPostImageFactory::new();
    }

}