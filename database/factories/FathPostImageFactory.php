<?php

namespace Arafath57\BlogPackage\Database\Factories;

use Arafath57\BlogPackage\Models\FathPost;
use Arafath57\BlogPackage\Models\FathPostImage;
use Arafath57\BlogPackage\Tests\User;
use Arafath57\BlogPackage\Tests\UserFactory;
use Illuminate\Database\Eloquent\Factories\Factory;

class FathPostImageFactory extends Factory
{
    protected $model = FathPostImage::class;


    public function definition(): array
    {
        $post = FathPost::factory()->create();
        return [
            'path'     => $this->faker->words(3, true),
            'fath_post_id'=> $post->id,
        ];
    }
}
