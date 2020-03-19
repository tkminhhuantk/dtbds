<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TagProject extends Model
{
    protected $table = 'tag_project';
    protected $guarded = 'id';
    public $timestamps = true;
    
    function tags(){
        return $this->belongsTo('App\Tags','tag_id','id');
    }
}
