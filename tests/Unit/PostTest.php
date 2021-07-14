<?php

namespace Arafath57\BlogPackage\Tests\Unit;

use Arafath57\BlogPackage\Models\FathPostCategory;
use Arafath57\BlogPackage\Models\FathPostComment;
use Arafath57\BlogPackage\Tests\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Arafath57\BlogPackage\Tests\TestCase;
use Arafath57\BlogPackage\Models\FathPost;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Str;

class PostTest extends TestCase
{
    use RefreshDatabase,WithFaker;

    /** @test */
    function a_post_has_a_title()
    {
        $post = FathPost::factory()->create();
        $this->assertNotEmpty( $post->title);
    }

    /** @test */
    function a_post_has_a_body(){
    $post = FathPost::factory()->create();
    $this->assertNotEmpty($post->body);
}
    /** @test */
    function a_post_has_author_id(){
        // Note that we are not assuming relations here, just that we have a column to store the 'id' of the author
        $post = FathPost::factory()->create();
        $this->assertNotEmpty($post->author_id);
    }

    /** @test */
    function a_post_has_an_author_type(){
        $post = FathPost::factory()->create();
        $this->assertEquals("Arafath57\BlogPackage\Tests\User",$post->author_type);
    }

    /** @test */
    function a_post_belongs_to_an_author(){
        //Given we have an author
        $author = User::factory()->create();
        $postDatas = FathPost::factory()->create()->toArray();
        $postDatas['id'] = random_int(5,99);
        $postDatas['slug'] = Str::random(15);
        $postDatas['author_id'] =1;
        //And this author has post
        $author->posts()->create($postDatas);
        $this->assertCount(2,FathPost::all());
        $this->assertCount(1,$author->posts);

        //Using tap() to aliases->posts()->first() to $post
        //To provide cleaner and grouped assertion
        tap($author->posts()->first(),function ($post) use($author){
            $this->assertNotEmpty($post->title);
            $this->assertNotEmpty($post->body);
            $this->assertTrue($post->author->is($author));
        });
    }
    /** @test */

    function a_post_has_a_category(){
        $category = FathPostCategory::factory()->create();

        $post = FathPost::factory()->create([
            'fath_post_category_id' => $category->id,
        ]);
        $post->load("category");
        $this->assertTrue($post->category->is($category));
    }

    /** @test */

    function a_post_has_a_comments(){
        $post = FathPost::factory()
            ->create();
        $author = User::factory()->create();
        $post->load("category","comments");
        $post->comments()->create([
            "content"=>$this->faker->text,
            "author_id"=>$author->id,
            "author_type"=>get_class($author)
        ]);
        $this->assertEquals(1,$post->comments()->count());
    }

/** @test */
    function an_author_has_a_comment(){
        $author = User::factory()->create();
        $post = FathPost::factory()->create(["author_id"=>$author->id]);
        $comment = FathPostComment::factory()->create([
            "fath_post_id"=>$post->id,
            "author_id"=>$author->id
        ]);
        $comment->load("author");
        $this->assertTrue($comment->author->is($author));
    }
}