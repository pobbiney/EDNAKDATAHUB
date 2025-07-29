<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class IncidentReport extends Model
{
     function incidentname(){
        return $this->belongsTo(Incident::class, 'incident_id', 'id');
    }

     function assignedstaff(){
        return $this->belongsTo(Staff::class, 'assignedto','staff_id');
    }

    function region(){
        return $this->belongsTo(Region::class, 'region_id');
    }
}
