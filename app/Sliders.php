<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sliders extends Model
{
    protected $table='sliders';
    protected $fillable=['url_slider','priority','created_at','updated_at'];
    protected $guarded='id';
    public $timestamps = true;
}
