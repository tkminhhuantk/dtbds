<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddTagRequest;
use App\Http\Requests\UpdateTagRequest;
use App\Tags;
use App\TagNew;
use App\TagProject;
use Illuminate\Http\Request;

class TagsController extends Controller
{
    public function getIndex()
    {
    	$tags = Tags::orderBy('created_at', 'desc')->paginate(10);
    	return view('backend.tags.index', compact('tags'));
    }

    public function postAdd(AddTagRequest $request)
    {
    	$tag = new Tags;
    	$tag->title = $request->title;
    	$tag->slug = $request->slug;
    	$tag->description = $request->description;
    	$tag->count = 0;
    	$tag->save();
    	return response()->json($tag, 200);
    }

    public function getUpdate($id)
    {
    	$tags = Tags::orderBy('created_at', 'desc')->paginate(10);
    	$tag = Tags::findOrFail($id);
    	return view('backend.tags.update', [
    		'tags' => $tags,
    		'tag' => $tag
    	]);
    }

    public function postUpdate(UpdateTagRequest $request, $id)
    {
    	$tag = Tags::findOrFail($id);
    	$tag->title = $request->title;
    	$tag->slug = $request->slug;
    	$tag->description = $request->description;
    	$tag->save();
    	return response()->json($tag, 200);
    }

    public function getDelete($id)
    {
    	$tag = Tags::findOrFail($id);
    	$tag->delete();
    	$tagNew = TagNew::where('tag_id', $tag->id)->get();
    	foreach($tagNew as $t){
    	    $t->delete();
    	}
    	$tagProject = TagProject::where('tag_id', $tag->id)->get();
    	foreach($tagProject as $t){
    	    $t->delete();
    	}
    	return response()->json($tag, 200);
    }
    
    /****************Editor*****************/
    public function getIndexEditor()
    {
        $tags = Tags::orderBy('created_at', 'desc')->paginate(10);
        return view('editor.tags.index', compact('tags'));
    }

    public function getUpdateEditor($id)
    {
        $tags = Tags::orderBy('created_at', 'desc')->paginate(10);
        $tag = Tags::findOrFail($id);
        return view('editor.tags.update', [
            'tags' => $tags,
            'tag' => $tag
        ]);
    }

    public function postAddEditor(AddTagRequest $request)
    {
        $tag = new Tags;
        $tag->title = $request->title;
        $tag->slug = $request->slug;
        $tag->description = $request->description;
        $tag->count = 0;
        $tag->save();
        return response()->json($tag, 200);
    }

    public function postUpdateEditor(UpdateTagRequest $request, $id)
    {
        $tag = Tags::findOrFail($id);
        $tag->title = $request->title;
        $tag->slug = $request->slug;
        $tag->description = $request->description;
        $tag->save();
        return response()->json($tag, 200);
    }
}
