<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Screening extends Model
{
    
	public function permitApp() {
		return $this->belongsTo(PermitRegistration::class, 'formId', 'formID'); // If taskId is your FK
		// or more conventionally:
		// return $this->belongsTo(PemitAPp::class, 'certificate_app_id');
	}

    public function getStaff(){
        return $this->belongsTo(Staff::class, 'created_by', 'staff_id');
    }

	public function getdecision(){
		return $this->belongsTo(ScreenDecision::class, 'severity','id');
	}
}
