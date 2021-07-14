<?php

namespace Arafath57\BlogPackage\Http\Controllers;

use Arafath57\BlogPackage\Models\FathPost;
use Arafath57\BlogPackage\Models\FathPostCategory;
use Arafath57\BlogPackage\Models\FathPostImage;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class FathPostController extends Controller
{
    public function list()
    {
        $posts = FathPost::with('comment','category')->where('status',FathPost::PUBLISHED)->get();
        return view('blogpackage::posts.list', compact('posts'));
    }
    public function index()
    {
        $posts = FathPost::all();
        return view('blogpackage::posts.index', compact('posts'));
    }

    public function show($post_id)
    {
        $post = FathPost::findOrFail($post_id);
        return view('blogpackage::posts.show', compact('post'));
    }
    public function details($slug)
    {
        $post = FathPost::with('comment.author','category')->where("slug",$slug)->first();
        return view('blogpackage::posts.details', compact('post'));
    }
    
    public function create(){
        $categories = FathPostCategory::all();
        return view("blogpackage::posts.create-edit",compact('categories'));
    }
    public function edit($post_id){
        $post = FathPost::findOrFail($post_id);
        $categories = FathPostCategory::all();
        return view("blogpackage::posts.create-edit",compact("post",'categories'));
    }

    public function update(Request  $request){
        $post = FathPost::find($request->post_id);
        if ($post!=null){
            if (isset($request->images)) {
                $this->saveFathPostImages($request, $post);
            }
            $post->update($request->all());
            return redirect(route("fath.post.index"))->with(['error'=>false,"message"=>"Post updated successfully"]);
        }else{
            return back()->with(["error"=>true,"message"=>"The post you are trying to update cannot be found"]);
        }
    }
    public function store(Request  $request)
    {
        // Let's assume we need to be authenticated
        // to create a new post
        if (! auth()->check()) {
            abort (403, 'Only authenticated users can create new posts.');
        }
        request()->validate([
            'title' => 'required',
            'body'  => 'required',
        ]);

        // Assume the authenticated user is the post's author
        $author = auth()->user();
        $datas = $request->all();
        $datas['slug']= Str::random(15);
        $post = $author->posts()->create($datas);
        if (isset($request->images)) {
            $this->saveFathPostImages($request, $post);
        }
        return redirect(route('fath.posts.show', $post));
    }
    public function destroy($post_id){
        $post = FathPost::find($post_id);
        if ($post==null)
            return redirect(route("fath.post.index"))->with(['error'=>true,"message"=>"The post you are trying to delete do not exist"]);
        return redirect(route("fath.post.index"))->with(['error'=>false,"message"=>"Post deleted successfully"]);

    }

    /**
     * @param Request $request
     * @param $post
     */
    public function saveFathPostImages(Request $request, $post): void
    {
            for ($i = 0; $i < count($request->images); $i++) {
                $image = $request->images[$i];
                $filename = 'fath_post_image_' . time() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('fath_post_images'), $filename);
                FathPostImage::create([
                    "path" => asset("fath_post_images/" . $filename),
                    "fath_post_id" => $post->id
                ]);
            }


    }
}
