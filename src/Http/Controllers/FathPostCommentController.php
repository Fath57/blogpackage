<?php

namespace Arafath57\BlogPackage\Http\Controllers;

use Arafath57\BlogPackage\Models\FathPostComment;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class FathPostCommentController extends Controller
{
    public function index()
    {
        $comments = FathPostComment::all();
        return view('blogpackage::comments.index', compact('comments'));
    }

    public function show($comment_id)
    {
        $comment = FathPostComment::findOrFail($comment_id);
        return view('blogpackage::comments.show', compact('comment'));
    }

    public function update(Request  $request){
        $comment = FathPostComment::find($request->comment_id);
        if ($comment!=null){
            $comment->update($request->all());
            return redirect(route("fath.comment.index"))->with(['error'=>false,"message"=>"Post updated successfully"]);
        }else{
            return back()->with(["error"=>true,"message"=>"The comment you are trying to update cannot be found"]);
        }
    }
    public function store(Request  $request)
    {
        // Let's assume we need to be authenticated
        // to create a new comment
        if (! auth()->check()) {
            abort (403, 'Only authenticated users can create new comments.');
        }
        request()->validate([
            'content' => 'required',
        ]);
        // Assume the authenticated user is the comment's author
        $author = auth()->user();
        $datas = $request->all();
        $datas['slug']= Str::random(15);
        $datas['fath_post_id']=$request->post_id;
        $comment = $author->comments()->create($datas);
        return back()->with(['error'=>false,"massage"=>"Comment created successfully",'comment'=>$comment]);
    }
    public function destroy($comment_id){
        $comment = FathPostComment::find($comment_id);
        if ($comment==null)
            return redirect(route("fath.comment.index"))->with(['error'=>true,"message"=>"The comment you are trying to delete do not exist"]);
        return redirect(route("fath.comment.index"))->with(['error'=>false,"message"=>"Post deleted successfully"]);

    }


}
