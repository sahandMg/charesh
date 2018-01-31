<?php

namespace App;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;

class Organize extends Model
{
    use Sluggable;
    protected $fillable=[

        'totalTickets','credit','address','email','telegram','comment','logo_path','background_path','unread'

    ];

    public function user(){

      return  $this->belongsTo('App\User');
    }
    public function tournaments(){

        return $this->hasMany('App\Tournament');


    }

    public function groupBracket(){


        return $this->hasOne('App\GroupBracket');

    }


    public function messages(){


        return $this->hasMany('App\Message');

    }

    public function sluggable(): array
    {

        return [
            'slug' => [
                'source' => 'name'
            ]
        ];

    }


}
