<?php

namespace Arafath57\BlogPackage\Database\Factories;

use Arafath57\BlogPackage\Models\FathPost;
use Arafath57\BlogPackage\Models\FathPostComment;
use Arafath57\BlogPackage\Tests\User;
use Arafath57\BlogPackage\Tests\UserFactory;
use Illuminate\Database\Eloquent\Factories\Factory;

class FathPostCommentFactory extends Factory
{
    protected $model = FathPostComment::class;


    public function definition(): array
    {
        $user = User::factory()->create();
        return [
            'content'      => $this->faker->paragraph,
            'author_id' => $user->id,
            'author_type' => get_class($user),
        ];
    }
}
