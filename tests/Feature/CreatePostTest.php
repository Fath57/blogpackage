<?php

namespace Arafath57\BlogPackage\Tests\Feature;

use Arafath57\BlogPackage\Models\FathPostCategory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Arafath57\BlogPackage\Models\FathPost;
use Arafath57\BlogPackage\Tests\TestCase;
use Arafath57\BlogPackage\Tests\User;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Mockery\Mock;

class CreatePostTest extends TestCase
{
    use RefreshDatabase,WithFaker;


    /** @test */
    function authenticated_users_can_create_a_post()
    {
        // To make sure we don't start with a Post
        $this->assertCount(0, FathPost::all());

        $author = User::factory()->create();
        $category = FathPostCategory::factory()->create();
        $data = [
            'slug'     => $this->faker->slug(12).time(),
            'title'     => $this->faker->words(3, true),
            'key_words'      => $this->faker->text,
            'body'      => $this->faker->paragraph,
            'summary'      => $this->faker->paragraph,
            'status'      => "draft",
            'author_id' => $author->id,
            'fath_post_category_id' => $category->id,
            'author_type' => get_class($author),
            ];
        $response = $this->actingAs($author)->post(route('fath.posts.store'), $data);

        $this->assertCount(1, FathPost::all());

        tap(FathPost::first(), function ($post) use ($response, $author) {
            $this->assertNotEmpty( $post->title);
            $this->assertNotEmpty( $post->body);
            $this->assertTrue($post->author->is($author));
            $response->assertRedirect(route('fath.posts.show', $post));
        });
    }
    /** @test */
    function a_post_requires_a_title_and_a_body()
    {
        $author = User::factory()->create();

        $this->actingAs($author)->post(route('fath.posts.store'), [
            'title' => '',
            'body'  => 'Some valid body',
        ])->assertSessionHasErrors('title');

        $this->actingAs($author)->post(route('fath.posts.store'), FathPost::factory()->create([
            "slug"=>"lkeke",
            "title"=>""
        ])->toArray())
            ->assertSessionHasErrors('title');
    }
    /** @test */
    function guests_can_not_create_posts()
    {
        // We're starting from an unauthenticated state
        $this->assertFalse(auth()->check());

        $this->post(route('fath.posts.store'), FathPost::factory()->create()->toArray())->assertForbidden();
    }
    /** @test */
    function all_posts_are_shown_via_the_index_route()
    {
        // Given we have a couple of Posts
        FathPost::factory()->create([
            'title' => 'Post number 1'
        ]);
        FathPost::factory()->create([
            'title' => 'Post number 2'
        ]);
        FathPost::factory()->create([
            'title' => 'Post number 3'
        ]);

        // We expect them to all show up
        // with their title on the index route
        $this->get(route('fath.posts.index'))
            ->assertSee('Post number 1')
            ->assertSee('Post number 2')
            ->assertSee('Post number 3')
            ->assertDontSee('Post number 4');
    }

    /** @test */
    function a_single_post_is_shown_via_the_show_route()
    {
        $post = FathPost::factory()->create();
        $this->get(route('fath.posts.show', $post->id))
            ->assertSee($post->title)
            ->assertSee($post->body);
    }
}