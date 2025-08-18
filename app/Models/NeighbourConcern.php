<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NeighbourConcern extends Model
{
    protected $table = 'neighbour_concerns';
    protected $fillable = [
        'app_id',
        'full_name',
        'telephone',
        'location',
        'concern',
        'status',
        'created_by'
    ];

     public function permit(){
        return $this->belongsTo(PermitRegistration::class, 'app_id');
    }
}
