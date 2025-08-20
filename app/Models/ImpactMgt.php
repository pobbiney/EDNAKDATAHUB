<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ImpactMgt extends Model
{
      protected $table = 'impact_managements';
    protected $fillable = [
        'app_id',
        'env_impact_id',
        'construction_mgt',
        'operational_mgt',
        'status',
        'created_by'
    ];

     public function permit(){
        return $this->belongsTo(PermitRegistration::class, 'app_id');
    }

     public function env_impact(){
        return $this->belongsTo(EnvironmentalImpact::class, 'env_impact_id');
    }

}
