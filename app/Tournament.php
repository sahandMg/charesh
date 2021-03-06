<?php

namespace App;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;

class Tournament extends Model
{
    use Sluggable;
    protected $fillable =['mode','matchType','maxAttenders','attendType','prize','rules','plan','cost','moreInfo','email','telegram',

        'city','matchName','path','url','startTime','endTimeDays','endTime','tickets','canceled','comment','endRemain','maxTeam','subst','maxMember','sold','address'

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

    public function groups(){

        return $this->hasMany('App\Group');
    }


    /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'matchName'
            ]
        ];
    }
}
