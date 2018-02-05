<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Junk extends Model
{
    protected $fillable =['mode','matchType','maxAttenders','attendType','prize','rules','plan','cost','moreInfo','email','telegram',

        'city','matchName','url','startTime','endTime','comment','endRemain','maxTeam','subst','maxMember','lat','lng','address'

    ];
}
