<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class CommanderAssignment
 * 
 * @property int $id
 * @property string|null $commander_id
 * @property string|null $station
 * @property string|null $region_id
 * @property string|null $district_id
 * @property string|null $assigned_by
 * @property Carbon|null $assigned_on
 *
 * @package App\Models
 */
class CommanderAssignment extends Model
{
	protected $table = 'commander_assignment';
	public $timestamps = false;

	protected $casts = [
		'assigned_on' => 'datetime'
	];

	protected $fillable = [
		'commander_id',
		'station',
		'region_id',
		'district_id',
		'assigned_by',
		'assigned_on'
	];
}
