<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class IncidentImage extends Model
{
 protected $fillable = ['incident_id', 'image'];

    public function incident()
    {
        return $this->belongsTo(Incident::class);
    }
}
