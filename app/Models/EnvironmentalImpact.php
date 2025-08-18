<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EnvironmentalImpact extends Model
{
     protected $table = 'env_impacts';
    protected $fillable = [
        'app_id',
        'construction_impact',
        'operational_impact',
        'status',
        'created_by'
    ];

    public function permit(){
        return $this->belongsTo(PermitRegistration::class, 'app_id');
    }

    public function impact_mgt(){
        return $this->hasOne(ImpactMgt::class, 'env_impact_id');
    }


}
