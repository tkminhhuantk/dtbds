<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProjectDetail extends Model
{
    protected $table='project_detail';
    protected $fillable=['project_id','detail_id','value','created_at','updated_at'];
    protected $guarded='id';
    public $timestamps = true;

    function details(){
        return $this->belongsTo('App\Details','detail_id','id');
    }
}
