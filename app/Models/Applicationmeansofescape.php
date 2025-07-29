<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Applicationmeansofescape
 * 
 * @property int $id
 * @property int $meansOfEscapeId
 * @property int $appId
 * @property int $createdBy
 * @property Carbon $createdOn
 *
 * @package App\Models
 */
class Applicationmeansofescape extends Model
{
	protected $table = 'applicationmeansofescape';
	public $timestamps = false;

	protected $casts = [
		'meansOfEscapeId' => 'int',
		'appId' => 'int',
		'createdBy' => 'int',
		'createdOn' => 'datetime'
	];

	protected $fillable = [
		'meansOfEscapeId',
		'appId',
		'createdBy',
		'createdOn'
	];
}
