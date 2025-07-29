<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Applicationfirefighting
 * 
 * @property int $id
 * @property int $fireFightingId
 * @property int $appId
 * @property int $createdBy
 * @property Carbon|null $createdOn
 *
 * @package App\Models
 */
class Applicationfirefighting extends Model
{
	protected $table = 'applicationfirefighting';
	public $timestamps = false;

	protected $casts = [
		'fireFightingId' => 'int',
		'appId' => 'int',
		'createdBy' => 'int',
		'createdOn' => 'datetime'
	];

	protected $fillable = [
		'fireFightingId',
		'appId',
		'createdBy',
		'createdOn'
	];
}
