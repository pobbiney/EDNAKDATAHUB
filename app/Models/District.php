<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class District extends Model
{
    function region(){
        return $this->belongsTo(Region::class, 'region_id','id');
    }
}
