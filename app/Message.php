<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    public function tournament(){

        return $this->belongsTo('App\Tournament');


    }


    public function organize(){

        return $this->belongsTo('App\Organize');
    }
}
