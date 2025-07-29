<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Transfer
 * 
 * @property int $id
 * @property string|null $staffID
 * @property string|null $rank
 * @property string|null $current_station
 * @property string|null $new_station
 * @property string|null $district_id
 * @property string|null $region_id
 * @property Carbon|null $date
 * @property string|null $created_by
 * @property string|null $approved_by
 * @property string|null $approved_on
 * @property string|null $status
 * @property string|null $reason
 *
 * @package App\Models
 */
class Transfer extends Model
{
	protected $table = 'transfer';
	public $timestamps = false;

	protected $casts = [
		'date' => 'datetime'
	];

	protected $fillable = [
		'staffID',
		'rank',
		'current_station',
		'new_station',
		'district_id',
		'region_id',
		'date',
		'created_by',
		'approved_by',
		'approved_on',
		'status',
		'reason'
	];
}
