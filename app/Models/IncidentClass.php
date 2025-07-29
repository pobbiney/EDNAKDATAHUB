<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class IncidentClass
 * 
 * @property int $id
 * @property string|null $name
 * @property string|null $description
 * @property string|null $status
 *
 * @package App\Models
 */
class IncidentClass extends Model
{
	protected $table = 'incident_class';
	public $timestamps = false;

	protected $fillable = [
		'name',
		'description',
		'status'
	];
}
