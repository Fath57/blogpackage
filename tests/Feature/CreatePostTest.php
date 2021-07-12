<?php

namespace Arafath57\BlogPackage\Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Arafath57\BlogPackage\Models\Post;
use Arafath57\BlogPackage\Tests\TestCase;
use Arafath57\BlogPackage\Tests\User;

class CreatePostTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    function authenticated_users_can_create_a_post()
    {
        // To make sure we don't start with a Post
        $this->assertCount(0, Post::all());

        $author = User::factory()->create();

        $response = $this->actingAs($author)->post(route('posts.store'), [
            'title' => 'My first fake title',
            'body'  => 'My first fake body',
        ]);

        $this->assertCount(1, Post::all());

        tap(Post::first(), function ($post) use ($response, $author) {
            $this->assertEquals('My first fake title', $post->title);
            $this->assertEquals('My first fake body', $post->body);
            $this->assertTrue($post->author->is($author));
            $response->assertRedirect(route('posts.show', $post));
        });
    }
    /** @test */
    function a_post_requires_a_title_and_a_body()
    {
        $author = User::factory()->create();

        $this->actingAs($author)->post(route('posts.store'), [
            'title' => '',
            'body'  => 'Some valid body',
        ])->assertSessionHasErrors('title');

        $this->actingAs($author)->post(route('posts.store'), [
            'title' => 'Some valid title',
            'body'  => '',
        ])->assertSessionHasErrors('body');
    }
    /** @test */
    function guests_can_not_create_posts()
    {
        // We're starting from an unauthenticated state
        $this->assertFalse(auth()->check());

        $this->post(route('posts.store'), [
            'title' => 'A valid title',
            'body'  => 'A valid body',
        ])->assertForbidden();
    }
    /** @test */
    function all_posts_are_shown_via_the_index_route()
    {
        // Given we have a couple of Posts
        Post::factory()->create([
            'title' => 'Post number 1'
        ]);
        Post::factory()->create([
            'title' => 'Post number 2'
        ]);
        Post::factory()->create([
            'title' => 'Post number 3'
        ]);

        // We expect them to all show up
        // with their title on the index route
        $this->get(route('posts.index'))
            ->assertSee('Post number 1')
            ->assertSee('Post number 2')
            ->assertSee('Post number 3')
            ->assertDontSee('Post number 4');
    }

    /** @test */
    function a_single_post_is_shown_via_the_show_route()
    {
        $post = Post::factory()->create([
            'title' => 'The single post title',
            'body'  => 'The single post body',
        ]);

        $this->get(route('posts.show', $post))
            ->assertSee('The single post title')
            ->assertSee('The single post body');
    }
}