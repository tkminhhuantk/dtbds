<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StatesProject extends Model
{
    protected $table='states_project';
    protected $fillable=['title','excerpt','created_at','updated_at'];
    protected $guarded='id';
    public $timestamps = true;
}
