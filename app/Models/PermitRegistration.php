<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PermitRegistration extends Model
{
    function appname(){
        return $this->belongsTo(Formsale::class, 'formID', 'id');
    }

    public function tasks()
    {
        return $this->hasMany(Task::class, 'application_id'); 
    }

 
    public function getRegion(){
        return $this->belongsTo(Region::class, 'region', 'id');
    }

     public function getDistrict(){
        return $this->belongsTo(District::class, 'district', 'id');
    }
 
    public function type(){
        return $this->belongsTo(ProjectType::class, 'type_id', 'id');
    }

    public function category(){
        return $this->belongsTo(ProjectCategory::class, 'cat_id', 'id');
    }

    public function sector(){
        return $this->belongsTo(ProjectSector::class, 'sector_id', 'id');
    }
 
 
 
 
}
