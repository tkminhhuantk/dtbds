<?php

namespace App;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    use Sluggable;

    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }
    
    protected $table='news';
    protected $fillable=['title','slug','except','meta_description','meta_keyword','link_avatar','seo_head','content','status','view','user_id','created_at','updated_at'];
    protected $guarded='id';
    public $timestamps = true;

    function users()
    {
        return $this->belongsTo('App\User', 'user_id', 'id');
    }
}
