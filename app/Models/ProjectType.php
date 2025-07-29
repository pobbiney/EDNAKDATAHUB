<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProjectType extends Model
{
    
    function catname(){
        return $this->belongsTo(ProjectCategory::class, 'category_id','id');
    }

    function secname(){
        return $this->belongsTo(ProjectSector::class, 'sector_id', 'id');
    }
}
