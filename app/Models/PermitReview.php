<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PermitReview extends Model
{
    public function getdecision(){
		return $this->belongsTo(ScreenDecision::class, 'decision_id','id');
	}
}
