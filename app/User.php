<?php

namespace App;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Passport\HasApiTokens;


class User extends Authenticatable
{
    use Notifiable;
    use HasApiTokens, Notifiable;
    use Sluggable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','credit','path','unread','slug','role'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];


    public function organize(){

      return  $this->hasOne('App\Organize');

    }

    public function tournaments(){

        return $this->hasMany('App\Tournament');

    }

    public function matches(){

        return $this->hasMany('App\Match');
    }

    public function messages(){

        return $this->hasMany('App\Message');

    }

    /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */


    /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
    public function sluggable(): array
    {

        return [
            'slug' => [
                'source' => 'username'
            ]
        ];

    }
}
