<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tournament extends Model
{

    protected $fillable =['mode','matchType','maxAttenders','attendType','prize','rules','plan','cost','moreInfo','email','telegram',

        'matchName','url','startTime','endTimeDays','endTime','tickets','canceled','comment','endRemain','maxTeam','minMember','maxMember','sold',

        ];
    public function organize(){



        return $this->belongsTo('App\Organize');

    }

    public function teams(){

        return $this->hasMany('App\Team');

    }

    public function groupBracket(){

        return $this->hasOne('App\GroupBracket');
    }

    public function leagueBracket(){

        return $this->hasOne('App\LeagueBracket');
    }


    public function matches(){

        return $this->hasMany('App\Match');
    }

}
