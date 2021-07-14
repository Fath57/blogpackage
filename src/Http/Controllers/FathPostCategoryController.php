<?php

namespace Arafath57\BlogPackage\Http\Controllers;

use Arafath57\BlogPackage\Models\FathPostCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class FathPostCategoryController extends Controller
{
    public function index()
    {
        $categories = FathPostCategory::all();
        return view('blogpackage::categories.index', compact('categories'));
    }

    public function show($category_id)
    {
        $category = FathPostCategory::findOrFail($category_id);
        return view('blogpackage::categories.show', compact('category'));
    }

    public function update(Request  $request){
        $category = FathPostCategory::find($request->category_id);
        $datas = $request->all();
        if ($category!=null){
            if (isset($request->image)) {
                    $image = $request->image;
                    $filename = 'fath_category_image_' . time() . '.' . $image->getClientOriginalExtension();
                    $image->move(public_path('fath_category_images'), $filename);
                    $datas['image'] = asset("fath_category_images/".$filename);
            }
            $category->update($datas);
            return redirect(route("fath.category.index"))->with(['error'=>false,"message"=>"Post updated successfully"]);
        }else{
            return back()->with(["error"=>true,"message"=>"The category you are trying to update cannot be found"]);
        }
    }
    public function store(Request  $request)
    {
        // Let's assume we need to be authenticated
        // to create a new category
        if (! auth()->check()) {
            abort (403, 'Only authenticated users can create new categories.');
        }
        request()->validate([
            'title' => 'required',
        ]);
        $datas = $request->all();
        $datas['slug']= Str::random(15);
        if (isset($request->image)) {
            $image = $request->image;
            $filename = 'fath_category_image_' . time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('fath_category_images'), $filename);
            $datas['image'] = asset("fath_category_images/".$filename);
        }
        $category = FathPostCategory::create($datas);
        return redirect(route('fath.categories.show', $category));
    }
    public function destroy($category_id){
        $category = FathPostCategory::find($category_id);
        if ($category==null)
            return redirect(route("fath.category.index"))->with(['error'=>true,"message"=>"The category you are trying to delete do not exist"]);
        return redirect(route("fath.category.index"))->with(['error'=>false,"message"=>"Post deleted successfully"]);

    }

}
