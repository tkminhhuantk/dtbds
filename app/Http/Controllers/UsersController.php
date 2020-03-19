<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddAccountRequest;
use App\Http\Requests\UpdateMyAccountRequest;
use App\Http\Requests\UpdatePassRequest;
use App\Permissions;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class UsersController extends Controller
{
    public function getMyAccount()
    {
    	$user = Auth::user();
    	if($user->url_avatar == null){
    		$user->url_avatar = 'images/avatar/no-image.jpg';
    	}
    	return view('backend.users.myAccount',[
    		'myUser' 	=> $user
    	]);
    }
    public function getMyAccountEditor()
    {
        $user = Auth::user();
        if($user->url_avatar == null){
            $user->url_avatar = 'images/avatar/no-image.jpg';
        }
        return view('editor.users.myAccount',[
            'myUser'    => $user
        ]);
    }
    public function postUpdateMyAccount(UpdateMyAccountRequest $request)
    {
    	$user = Auth::user();
    	$user->name = $request->post('name');
    	$user->phone = $request->post('phone');
    	$user->excerpt = $request->post('excerpt');
    	if ($request->hasFile('url_avatar')) {
            $file = $request->url_avatar;
            $user->url_avatar = 'images/avatar/' . time().'.'.$file->getClientOriginalExtension();
            $file->move('images/avatar/', time().'.'.$file->getClientOriginalExtension());
        }
    	$user->save();
    	if($user->url_avatar != null){
    		$user->url_avatar = asset($user->url_avatar);
    	}else{
    		$user->url_avatar = asset('images/avatar/no-image.jpg');
    	}
    	return response()->json($user, 200);
    }
    public function postChangePass(UpdatePassRequest $request)
    {
        $auth = Auth::user();
    	// if( bcrypt( $request->post('current_password') ) == $auth->password){
            $user = User::where('id', $auth->id)->first();
            $user->password = bcrypt( $request->post('new_password'));
            $user->save();
            return response()->json($user, 200);
        // }else{
        //     //err
        // }
    }
    public function getListAccount()
    {
    	$users = User::with('permissions')->orderBy('id','desc')->paginate(10);
    	return view('backend.users.listAccount', [
    		'users' => $users
    	]);
    }
    public function getAddAccount()
    {
    	$permissions = Permissions::orderBy('id','desc')->get();
    	return view('backend.users.addAccount', ['permissions' => $permissions]);
    }
    public function postAddAccount(AddAccountRequest $request)
    {
    	$user = new User;
    	if ($request->hasFile('url_avatar')) {
            $file = $request->url_avatar;
            $user->url_avatar = 'images/avatar/' . time().'.'.$file->getClientOriginalExtension();
            $file->move('images/avatar/', time().'.'.$file->getClientOriginalExtension());
        }else{
        	$user->url_avatar = null;
        }
        $user->name = $request->post('name');
        $user->email = $request->post('email');
        $user->phone = $request->post('phone');
        $user->excerpt = $request->post('excerpt');
        $user->password = bcrypt($request->post('password'));
        $user->permission = $request->post('permission');
        $user->save();
        return response()->json($user, 200);
    }
    public function getUpdateAccount($id)
    {
        $user = User::findOrFail($id);
        $permissions = Permissions::orderBy('id','desc')->get();
        return view('backend.users.updateAccount', ['user' => $user, 'permissions' => $permissions]);
    }

    public function postUpdateMyAccountEditor(UpdateMyAccountRequest $request)
    {
        $user = Auth::user();
        $user->name = $request->post('name');
        $user->phone = $request->post('phone');
        $user->excerpt = $request->post('excerpt');
        if ($request->hasFile('url_avatar')) {
            $file = $request->url_avatar;
            $user->url_avatar = 'images/avatar/' . time().'.'.$file->getClientOriginalExtension();
            $file->move('images/avatar/', time().'.'.$file->getClientOriginalExtension());
        }
        $user->save();
        if($user->url_avatar != null){
            $user->url_avatar = asset($user->url_avatar);
        }else{
            $user->url_avatar = asset('images/avatar/no-image.jpg');
        }
        return response()->json($user, 200);
    }
    public function postChangePassEditor(UpdatePassRequest $request)
    {
        $auth = Auth::user();
        // if( bcrypt( $request->post('current_password') ) == $auth->password){
            $user = User::where('id', $auth->id)->first();
            $user->password = bcrypt( $request->post('new_password'));
            $user->save();
            return response()->json($user, 200);
        // }else{
        //     //err
        // }
    }
    public function getChangeStatus($id)
    {
        $user = User::findOrFail($id);
        $user->status == 1 ? $user->status = 0 : $user->status = 1;
        $user->save();
        return response()->json($user, 200);
    }
}
