<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LibrariesController extends Controller
{
    public function getIndex()
    {
    	return view('backend.libraries.index');
    }
}
