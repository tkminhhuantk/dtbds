<?php

namespace App\Http\Controllers;

use App\Details;
use App\Http\Requests\CreateDetailRequest;
use App\Http\Requests\UpdateDetailRequest;
use Illuminate\Http\Request;

class DetailsController extends Controller
{
    public function getIndex(){
    	$details = Details::orderBy('created_at','desc')->get();
    	return view('backend.details.index',['details'=>$details]);
    }
    public function getIndexEditor(){
        $details = Details::orderBy('created_at','desc')->get();
        return view('editor.details.index',['details'=>$details]);
    }
    public function create(CreateDetailRequest $request){
    	$detail = Details::create([
    		'title' => $request->title,
    		'status' => ($request->status == 'true') ? true : false
    	]);
        $detail->url_status = route('AdminDetailsStatus',$detail->id);
        $detail->url_delete = route('AdminDetailsDelete',$detail->id);
        $detail->url_update = route('AdminDetailsGet',$detail->id);
    	return response()->json($detail,200);
    }
    public function delete($id){
    	$detail = Details::findOrFail($id);
    	$detail->delete();
    	return response()->json($detail,200);
    }
    public function status($id){
        $detail = Details::findOrFail($id);
        $detail->status =  !$detail->status;
        $detail->save();
        return response()->json($detail,200);
    }
    public function get($id){
        $detail = Details::findOrFail($id);
        $detail->url_update = route('AdminDetailsUpdate',$detail->id);
        return response()->json($detail,200);
    }
    public function update(UpdateDetailRequest $request, $id){
        $detail = Details::findOrFail($id);
        $detail->update(['title' => $request->title]);
        return response()->json($detail,200);
    }

    /*****************Editor******************/
    public function createEditor(CreateDetailRequest $request){
        $detail = Details::create([
            'title' => $request->title,
            'status' => true
        ]);
        return response()->json($detail,200);
    }
    public function getEditor($id){
        $detail = Details::findOrFail($id);
        $detail->url_update = route('EditorDetailsUpdate',$detail->id);
        return response()->json($detail,200);
    }
    public function updateEditor(UpdateDetailRequest $request, $id){
        $detail = Details::findOrFail($id);
        $detail->update(['title' => $request->title]);
        return response()->json($detail,200);
    }
}
