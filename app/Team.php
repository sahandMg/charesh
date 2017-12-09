<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    public function tournaments(){

        return $this->belongsToMany('App\Tournament');

    }

    public function messages(){

        return $this->hasMany('App\Message');
    }

    public function groups(){

        return $this->hasMany('App\Group');
    }

    public function match(){

        return $this->hasOne('App\Match');
    }
}
