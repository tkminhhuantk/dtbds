<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class LogoutController extends Controller
{
    function getLogout(){
    	Auth::logout();
    	return redirect()->route('getLogin');
    }
}