<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Applicationaccessroute
 * 
 * @property int $id
 * @property int $accessRouteId
 * @property int $appId
 * @property int $createdBy
 * @property Carbon|null $createdOn
 *
 * @package App\Models
 */
class Applicationaccessroute extends Model
{
	protected $table = 'applicationaccessroute';
	public $timestamps = false;

	protected $casts = [
		'accessRouteId' => 'int',
		'appId' => 'int',
		'createdBy' => 'int',
		'createdOn' => 'datetime'
	];

	protected $fillable = [
		'accessRouteId',
		'appId',
		'createdBy',
		'createdOn'
	];
}
