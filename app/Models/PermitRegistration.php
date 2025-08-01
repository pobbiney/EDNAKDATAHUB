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
        return $this->hasMany(Task::class, 'taskId', 'id'); // Adjust if your FK is different
    }

 
    public function getRegion(){
        return $this->belongsTo(Region::class, 'region', 'id');
    }

     public function getDistrict(){
        return $this->belongsTo(District::class, 'district', 'id');
    }
      public function gettyepename(){
        return $this->belongsTo(ProjectType::class, 'type_id', 'id');
    }
      public function getsectorname(){
        return $this->belongsTo(ProjectSector::class, 'sector_id', 'id');
    }
      public function getcatname(){
        return $this->belongsTo(ProjectCategory::class, 'cat_id', 'id');
    }
 
}
