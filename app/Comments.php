<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comments extends Model
{
    protected $table='comments';
    protected $fillable=['name','phone','email','content','type','comment_id','post_id','view','status','created_at','updated_at'];
    protected $guarded='id';
    public $timestamps = true;
}
