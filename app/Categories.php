<?php

namespace App;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;

class Categories extends Model
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

    protected $table='categories';
    protected $fillable=['title','slug','description','keywords','seo_head','category_id','status','created_at','updated_at'];
    protected $guarded='id';
    public $timestamps = true;
}
