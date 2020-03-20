<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddLinkRequest;
use App\Links;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class LinksController extends Controller
{
    public function getIndex()
    {
    	$links = Links::orderBy('created_at','desc')->paginate(10);
    	return view('backend.links.index',[
    		'links' => $links
    	]);
    }
    public function postAdd(AddLinkRequest $request)
    {
    	$link = new Links;
    	$link->title = $request->title;
    	$link->link = $request->link;
    	if ($request->hasFile('url_logo')) 
    	{
            $file = $request->url_logo;
            $link->url_logo = 'logo/' . time().'.'.$file->getClientOriginalExtension();
            $file->move('logo', time().'.'.$file->getClientOriginalExtension());
        }
    	$link->status = $request->status == 'true' ? true : false ;
    	$link->save();
    	return response()->json($link, 200);
    }
    public function getDelete($id)
    {
    	$link = Links::findOrFail($id);
    	$link->delete();
        if (file_exists(public_path($link->url_logo)))
        {
            File::delete(public_path($link->url_logo));
        }
    	return response()->json($link, 200);
    }
    public function getChangeStatus($id)
    {
        $link = Links::findOrFail($id);
        $link->status == 1 ? $link->status = 0 : $link->status = 1;
        return response()->json($link, 200);
    }
}
