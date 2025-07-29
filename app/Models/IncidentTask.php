<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class IncidentTask extends Model
{
    function taskname(){
        return $this->belongsTo(Staff::class, 'assignedto','staff_id');
    }

    function incidentname(){
        return $this->belongsTo(Incident::class, 'incident_id', 'id');
    }

    function region(){
        return $this->belongsTo(Region::class, 'regionId');
    }

     
}
