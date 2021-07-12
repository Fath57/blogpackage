<?php

namespace Arafath57\BlogPackage\Database\Factories;

use Arafath57\BlogPackage\Models\Post;
use Arafath57\BlogPackage\Tests\User;
use Arafath57\BlogPackage\Tests\UserFactory;
use Illuminate\Database\Eloquent\Factories\Factory;

class PostFactory extends Factory
{
    protected $model = Post::class;


    public function definition(): array
    {
        $user = User::factory()->create();
        return [
            'title'     => $this->faker->words(3, true),
            'body'      => $this->faker->paragraph,
            'author_id' => $user->id,
            'author_type' => get_class($user),
        ];
    }
}
