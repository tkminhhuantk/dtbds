<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TagNew extends Model
{
    protected $table = 'tag_new';
    protected $guarded = 'id';
    public $timestamps = true;

    function tags(){
        return $this->belongsTo('App\Tags','tag_id','id');
    }
}
