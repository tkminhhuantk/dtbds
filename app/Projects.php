<?php

namespace App;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;

class Projects extends Model
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
    
    protected $table='projects';
    protected $fillable=['title','slug','meta_description','meta_keyword','address','price','acreage','seo_head','except','seo','avatar','url_images','overview','investor_id','category_id','map','view','review','state','status','user_id','created_at','updated_at'];
    protected $guarded='id';
    public $timestamps = true;

    function categories()
    {
        return $this->belongsTo('App\Categories','category_id','id');
    }
    function investors()
    {
        return $this->belongsTo('App\Investors','investor_id','id');
    }
    function users()
    {
        return $this->belongsTo('App\User', 'user_id', 'id');
    }
    function statesProject()
    {
        return $this->belongsTo('App\StatesProject', 'state', 'id');
    }
}
