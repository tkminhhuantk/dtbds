<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Librarises extends Model
{
    protected $table='libraries';
    protected $fillable=['url_image','name','file_type','capaciry','created_at','updated_at'];
    protected $guarded='id';
    public $timestamps = true;
}
