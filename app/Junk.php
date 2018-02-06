<?php

namespace App;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;

class Junk extends Model
{
    use Sluggable;
    protected $fillable =['slug','mode','matchType','maxAttenders','attendType','prize','rules','plan','cost','moreInfo','email','telegram',

        'city','matchName','url','startTime','endTime','comment','endRemain','maxTeam','subst','maxMember','lat','lng','address'

    ];


    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'matchName'
            ]
        ];
    }
}
