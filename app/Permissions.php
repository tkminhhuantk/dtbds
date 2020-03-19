<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Permissions extends Model
{
    protected $table='permissions';
    protected $fillable=['title','excerpt','created_at','updated_at'];
    protected $guarded='id';
    public $timestamps = true;
}
