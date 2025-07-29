<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class IncidentType
 * 
 * @property int $id
 * @property string|null $name
 * @property string|null $class_id
 * @property string|null $status
 *
 * @package App\Models
 */
class IncidentType extends Model
{
	protected $table = 'incident_type';
	public $timestamps = false;

	protected $fillable = [
		'name',
		'class_id',
		'status'
	];

	public function classname()
	{
		return $this->belongsTo(IncidentCategory::class, 'class_id', 'id'); // Adjust if your FK is different
	}

	
	public function type()
{
    return $this->hasMany(Incident::class, 'type_id');
}

}
