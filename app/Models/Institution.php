<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Institution extends Model
{
     function catname(){
        return $this->belongsTo(InstitutionCategory::class, 'category_id','id');
    }

     function typename(){
        return $this->belongsTo(InstitutionType::class, 'type_id','id');
    }
}
