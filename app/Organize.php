<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Organize extends Model
{

    protected $fillable=[

        'totalTickets','credit','address','email','telegram','comment','logo_path','background_path'

    ];


    public function tournaments(){

        return $this->hasMany('App\Tournament');


    }

    public function groupBracket(){


        return $this->hasOne('App\GroupBracket');

    }


    public function messages(){


        return $this->hasMany('App\Message');

    }
}
