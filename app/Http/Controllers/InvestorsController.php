<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddInvestorRequest;
use App\Investors;
use Illuminate\Http\Request;

class InvestorsController extends Controller
{
    public function getIndex(){
    	$investors = Investors::orderBy('id','desc')->get();
    	return view('backend.investors.index',[
    		'investors' => $investors
    	]);
    }
    public function getIndexEditor(){
        $investors = Investors::orderBy('id','desc')->get();
        return view('editor.investors.index',[
            'investors' => $investors
        ]);
    }
    public function postAdd(AddInvestorRequest $request){
    	$investor = new Investors;
    	if ($request->hasFile('url_logo')) {
            $file = $request->url_logo;
            $investor->url_logo = 'investors/' . time().'.'.$file->getClientOriginalExtension();
            $file->move('investors', time().'.'.$file->getClientOriginalExtension());
        }
        $investor->name = $request->name;
        $investor->full_name = $request->full_name;
        // $investor->founding = $request->founding;
        $investor->link = $request->link;
        $investor->description = $request->description;
        $investor->status = $request->status == 'true' ? true : false ;
        $investor->save();
        if ($request->hasFile('url_logo')) {
        	$investor->url_logo = asset($investor->url_logo);
        }
        $investor->url_delete = route('AdminInvestorGetDelete',$investor->id);
        $investor->url_update = route('AdminInvestorGet', $investor->id);
        $investor->url_status = route('AdminInvestorChangeStatus', $investor->id);
    	return response()->json($investor,200);
    }
    public function getDelete($id){
    	$investor = Investors::findOrFail($id);
    	$investor->delete();
    	return response()->json($investor,200);
    }
    public function get($id)
    {
        $investor = Investors::findOrFail($id);
        return response()->json($investor, 200);
    }
    public function changeStatus($id)
    {
        $investor = Investors::findOrFail($id);
        $investor->status == 1 ? $investor->status = 0 : $investor->status = 1;
        $investor->save();
        return response()->json($investor, 200);
    }

    /**************Editor****************/
    public function postAddEditor(AddInvestorRequest $request){
        $investor = new Investors;
        if ($request->hasFile('url_logo')) {
            $file = $request->url_logo;
            $investor->url_logo = 'investors/' . time().'.'.$file->getClientOriginalExtension();
            $file->move('investors', time().'.'.$file->getClientOriginalExtension());
        }
        $investor->name = $request->name;
        $investor->full_name = $request->full_name;
        // $investor->founding = $request->founding;
        $investor->link = $request->link;
        $investor->description = $request->description;
        //$investor->status = $request->status == 'true' ? true : false ;
        $investor->status = true ;
        $investor->save();
        if ($request->hasFile('url_logo')) {
            $investor->url_logo = asset($investor->url_logo);
        }
        $investor->url_delete = route('AdminInvestorGetDelete',$investor->id);
        $investor->url_update = route('AdminInvestorGet', $investor->id);
        $investor->url_status = route('AdminInvestorChangeStatus', $investor->id);
        return response()->json($investor,200);
    }
}
