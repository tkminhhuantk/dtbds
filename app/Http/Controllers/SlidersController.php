<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateSliderRequest;
use App\Sliders;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class SlidersController extends Controller
{
    public function getIndex(){
    	$sliders = Sliders::orderBy('priority','asc')->get();
    	return view('backend.sliders.index',['sliders'=>$sliders]);
    }
    public function getIndexEditor(){
        $sliders = Sliders::orderBy('priority','asc')->get();
        return view('backend.sliders.index',['sliders'=>$sliders]);
    }
    public function create(CreateSliderRequest $request){
    	$slider = new Sliders;
    	if ($request->hasFile('url_slider')) {
            $file = $request->url_slider;
            $slider->url_slider = 'sliders/' . time().'.'.$file->getClientOriginalExtension();
            $file->move('sliders', time().'.'.$file->getClientOriginalExtension());
        }
        $slider->priority = Sliders::count();
        $slider->save();
        $slider->url_slider = asset($slider->url_slider);
        $slider->url_del = route('AdminSliderDelete', $slider->id);
        return response()->json($slider,200);
    }
    public function delete($id){
    	$slider = Sliders::findOrFail($id);
    	$slider->delete();
        if (file_exists(public_path($slider->url_slider)))
        {
            File::delete(public_path($slider->url_slider));
        }
    	return response()->json($slider,200);
    }
}
