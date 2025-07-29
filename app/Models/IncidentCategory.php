<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class IncidentCategory extends Model
{
   protected $table = 'incident_categories';
	public $timestamps = false;

    public function classname()
	{
		return $this->belongsTo(IncidentClass::class, 'incident_class', 'id'); // Adjust if your FK is different
	}

	public function incidents()
{
    return $this->hasMany(Incident::class, 'cat_id');
}

}
