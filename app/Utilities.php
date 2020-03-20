<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Utilities extends Model
{
    protected $table='utilities';
    protected $fillable=['title','status','created_at','updated_at'];
    protected $guarded='id';
    public $timestamps = true;
}
