<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Applicationwarningdevice
 * 
 * @property int $id
 * @property int $warningDeviceId
 * @property int $appId
 * @property int $createdBy
 * @property Carbon|null $createdOn
 *
 * @package App\Models
 */
class Applicationwarningdevice extends Model
{
	protected $table = 'applicationwarningdevice';
	public $timestamps = false;

	protected $casts = [
		'warningDeviceId' => 'int',
		'appId' => 'int',
		'createdBy' => 'int',
		'createdOn' => 'datetime'
	];

	protected $fillable = [
		'warningDeviceId',
		'appId',
		'createdBy',
		'createdOn'
	];
}
