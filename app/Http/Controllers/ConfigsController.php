<?php

namespace App\Http\Controllers;

use App\Config;
use App\Http\Requests\UpdateConfigRequest;
use Illuminate\Http\Request;

class ConfigsController extends Controller
{
    public function getIndex(){
    	$config = Config::firstOrCreate([
            'id' => 1
        ]);
    	return view('backend.configs.index', compact('config'));
    }

    public function update(UpdateConfigRequest $request)
    {
        $config = Config::first();
        $data = $request->except('_method', '_token', 'logo');
        if ($request->hasFile('logo')) {
            $file = $request->logo;
            $data['logo'] = 'logo/' . time().'.'.$file->getClientOriginalExtension();
            $file->move('logo', time().'.'.$file->getClientOriginalExtension());
        }
        $config->update($data);
        return response()->json($config, 200);
    }
}
