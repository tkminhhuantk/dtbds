<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','phone','excerpt','url_avatar','permission','status'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    function permissions()
    {
        return $this->belongsTo('App\Permissions','permission','id');
    }
    public function isAdmin()  
    {
        return $this->permission == 1;
    }
    public function isEditor()  
    {
        return $this->permission == 2;
    }
    public function isStatus()
    {
        return $this->status == 1;
    }
}
