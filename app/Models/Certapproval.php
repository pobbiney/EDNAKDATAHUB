<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Certapproval
 * 
 * @property int $id
 * @property int $appId
 * @property int $createdBy
 * @property Carbon $createdOn
 * @property string|null $comment
 * @property string|null $status
 * @property string|null $reason
 * @property string|null $region_id
 *
 * @package App\Models
 */
class Certapproval extends Model
{
	protected $table = 'certapproval';
	public $timestamps = false;

	protected $casts = [
		'appId' => 'int',
		'createdBy' => 'int',
		'createdOn' => 'datetime'
	];

	protected $fillable = [
		'appId',
		'createdBy',
		'createdOn',
		'comment',
		'status',
		'reason',
		'region_id'
	];
}
