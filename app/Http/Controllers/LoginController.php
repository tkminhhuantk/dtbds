<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class LoginController extends Controller
{
    public function getIndex(){
    	return view('frontend.login');
    }
    public function postIndex(LoginRequest $request){
        if( Auth::attempt(['email' => $request->email, 'password' => $request->password])){
            $userlogin = Auth::user();
            if(Gate::allows('isAdmin')){
                if(Gate::allows('isStatus')){
                    return redirect()->route('AdminSlider');
                }else{
                    return redirect()->back()->withInput()->with(['error'=>'Tài khoản đã bị tắt!']);
                }
                
            }elseif(Gate::allows('isEditor')){
                if(Gate::allows('isStatus')){
                    return redirect()->route('UsersGetMyAccountEditor');
                }else{
                    return redirect()->back()->withInput()->with(['error'=>'Tài khoản đã bị tắt!']);
                }
            }
        }else{
            return redirect()->back()->withInput()->with(['error'=>'Email hoặc mật khẩu không chính xác!']);
        }
    }
}
