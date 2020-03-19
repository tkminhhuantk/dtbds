<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProjectUtiliti extends Model
{
    protected $table='project_utiliti';
    protected $fillable=['project_id','utiliti_id','created_at','updated_at'];
    protected $guarded='id';
    public $timestamps = true;

    function utilities(){
        return $this->belongsTo('App\Utilities','utiliti_id','id');
    }
}
