<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LeagueBracket extends Model
{

    protected $fillable = ['RoundTable','LTable','row','teamName','point','type','column4','column5','column6','column7','column8','column9','column10',

        'column11','column12','columnNumber'
    ];
}
