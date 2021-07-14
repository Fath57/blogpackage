<?php

namespace Arafath57\BlogPackage\Database\Factories;

use Arafath57\BlogPackage\Models\FathPost;
use Arafath57\BlogPackage\Models\FathPostCategory;
use Arafath57\BlogPackage\Tests\User;
use Arafath57\BlogPackage\Tests\UserFactory;
use Illuminate\Database\Eloquent\Factories\Factory;

class FathPostFactory extends Factory
{
    protected $model = FathPost::class;


    public function definition(): array
    {
        $user = User::factory()->create();
        $category = FathPostCategory::factory()->create();
        return [
            'slug'     => $this->faker->slug(12).time(),
            'title'     => $this->faker->words(3, true),
            'key_words'      => $this->faker->text,
            'body'      => $this->faker->paragraph,
            'summary'      => $this->faker->paragraph,
            'status'      => "draft",
            'author_id' => $user->id,
            'fath_post_category_id' => $category->id,
            'author_type' => get_class($user),
        ];
    }
}
