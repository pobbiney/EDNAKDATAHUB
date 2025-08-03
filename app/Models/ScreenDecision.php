<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ScreenDecision extends Model
{
      public function getscreendecision(){
        return $this->belongsTo(Screening::class, 'severity', 'id');
    }
 
}
