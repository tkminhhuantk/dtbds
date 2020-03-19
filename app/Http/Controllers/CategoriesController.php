<?php

namespace App\Http\Controllers;

use App\Categories;
use App\Http\Requests\CreateCategoryRequest;
use Illuminate\Http\Request;

class CategoriesController extends Controller
{
    public function getIndex(){
    	$categories = Categories::where('category_id',0)->get();
    	foreach($categories as $category){
    		$category->sub = Categories::where('category_id',$category->id)->get();
    	}
    	return view('backend.categories.index',['categories'=>$categories]);
    }
    public function create(CreateCategoryRequest $request){
    	$category = Categories::create([
    		'title' => $request->title,
    		'description' => $request->description,
    		'keywords' => $request->keywords,
    		'seo_head' => $request->seo_head,
    		'category_id' => $request->category_id,
    		'status' => $request->status == 'true' ? true : false
    	]);
        return redirect()->route('AdminCategories')->with(['success' => 'Thêm thành công chuyên mục: ' . $request->title . '!']);
    }
    public function delete($id){
        $category = Categories::findOrFail($id);
        $category->delete();
        $subs = Categories::where('category_id',$category->id)->get();
        foreach ($subs as $sub) {
            $sub->update(['category_id'=>0]);
        }
        return redirect()->route('AdminCategories')->with(['success' => 'Xóa thành công chuyên mục: ' . $category->title . '!']);
    }
}
