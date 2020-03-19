<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateUtilitiRequest;
use App\Http\Requests\UpdateUtilitiRequest;
use App\Utilities;
use Illuminate\Http\Request;

class UtilitiesController extends Controller
{
    public function getIndex(){
    	$utilities = Utilities::orderBy('created_at','desc')->get();
    	return view('backend.utilities.index',['utilities'=>$utilities]);
    }
    public function getIndexEditor(){
        $utilities = Utilities::orderBy('created_at','desc')->get();
        return view('editor.utilities.index',['utilities'=>$utilities]);
    }
    public function create(CreateUtilitiRequest $request){
    	$utiliti = Utilities::create([
    		'title' => $request->title,
    		'status' => ($request->status == 'true') ? true : false
    	]);
    	$utiliti->url_delete = route('AdminUtilitiesDelete',$utiliti->id);
    	$utiliti->url_status = route('AdminUtilitiesStatus',$utiliti->id);
        $utiliti->url_update = route('AdminUtilitiesGet', $utiliti->id);
    	return response()->json($utiliti,200);
    }
    public function delete($id){
    	$utiliti = Utilities::findOrFail($id);
    	$utiliti->delete();
    	return response()->json($utiliti,200);
    }
    public function status($id){
    	$utiliti = Utilities::findOrFail($id);
    	$utiliti->status == 1 ? $utiliti->status = 0 : $utiliti->status = 1;
    	$utiliti->save();
    	return response()->json($utiliti,200);
    }
    public function get($id){
    	$utiliti = Utilities::findOrFail($id);
    	$utiliti->url_update = route('AdminUtilitiesUpdate',$utiliti->id);
    	return response()->json($utiliti,200);
    }
    public function update(UpdateUtilitiRequest $request, $id){
    	$utiliti = Utilities::findOrFail($id);
    	$utiliti->update([
    		'title' => $request->title
    	]);
    	return response()->json($utiliti,200);
    }

    /*************************Editor********************/
    public function createEditor(CreateUtilitiRequest $request){
        $utiliti = Utilities::create([
            'title' => $request->title,
            'status' => true
        ]);
        $utiliti->url_edit = route('EditorUtilitiesGet', $utiliti->id);
        return response()->json($utiliti,200);
    }
    public function getEditor($id){
        $utiliti = Utilities::findOrFail($id);
        $utiliti->url_update = route('EditorUtilitiesUpdate', $utiliti->id);
        return response()->json($utiliti,200);
    }
    public function updateEditor(UpdateUtilitiRequest $request, $id){
        $utiliti = Utilities::findOrFail($id);
        $utiliti->update([
            'title' => $request->title
        ]);
        return response()->json($utiliti,200);
    }
}
