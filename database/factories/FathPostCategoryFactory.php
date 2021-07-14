<?php

namespace Arafath57\BlogPackage\Database\Factories;

use Arafath57\BlogPackage\Models\FathPost;
use Arafath57\BlogPackage\Models\FathPostCategory;
use Arafath57\BlogPackage\Tests\User;
use Arafath57\BlogPackage\Tests\UserFactory;
use Illuminate\Database\Eloquent\Factories\Factory;

class FathPostCategoryFactory extends Factory
{
    protected $model = FathPostCategory::class;


    public function definition(): array
    {
        $user = User::factory()->create();
        return [
            'title'     => $this->faker->words(3, true),
            'description'      => $this->faker->paragraph,
        ];
    }
}
