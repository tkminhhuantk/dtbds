<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Details extends Model
{
    protected $table='details';
    protected $fillable=['title','status','created_at','updated_at'];
    protected $guarded='id';
    public $timestamps = true;
}
