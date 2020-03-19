<?php

namespace App;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;

class Investors extends Model
{
    use Sluggable;

    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }

    protected $table='investors';
    protected $fillable=['name','slug','full_name','url_logo','founding','link','description','status','created_at','updated_at'];
    protected $guarded='id';
    public $timestamps = true;
}
