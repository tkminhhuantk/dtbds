<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contacts extends Model
{
    protected $table='contacts';
    protected $fillable=['name','phone','email','title','content','view','created_at','updated_at'];
    protected $guarded='id';
    public $timestamps = true;
}
