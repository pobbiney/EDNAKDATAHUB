<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Station extends Model
{
    function region(){
        return $this->belongsTo(Region::class, 'region_id','id');
    }
}
