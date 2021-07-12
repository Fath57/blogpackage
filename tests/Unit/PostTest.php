<?php

namespace Arafath57\BlogPackage\Tests\Unit;

use Arafath57\BlogPackage\Tests\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Arafath57\BlogPackage\Tests\TestCase;
use Arafath57\BlogPackage\Models\Post;

class PostTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    function a_post_has_a_title()
    {
        $post = Post::factory()->create();
        $this->assertNotEmpty( $post->title);
    }

    /** @test */
    function a_post_has_a_body(){
    $post = Post::factory()->create();
    $this->assertNotEmpty($post->body);
}
    /** @test */
    function a_post_has_author_id(){
        // Note that we are not assuming relations here, just that we have a column to store the 'id' of the author
        $post = Post::factory()->create();
        $this->assertNotEmpty($post->author_id);
    }

    /** @test */
    function a_post_has_an_author_type(){
        $post = Post::factory()->create();
        $this->assertEquals("Arafath57\BlogPackage\Tests\User",$post->author_type);
    }

    /** @test */
    function a_post_belongs_to_an_author(){
        //Given we have an author
        $author = User::factory()->create();
        //And this author has post
        $author->posts()->create([
            "title"=>"My first fake post",
            "body"=>"Reading can heal your soul"
        ]);
        $this->assertCount(1,Post::all());
        $this->assertCount(1,$author->posts);

        //Using tap() to aliases->posts()->first() to $post
        //To provide cleaner and grouped assertion
        tap($author->posts()->first(),function ($post) use($author){
            $this->assertEquals("My first fake post",$post->title);
            $this->assertEquals('Reading can heal your soul',$post->body);
            $this->assertTrue($post->author->is($author));
        });
    }
}