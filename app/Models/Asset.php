<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Asset
 * 
 * @property int $id
 * @property string|null $name
 * @property string|null $class_id
 * @property string|null $type_id
 * @property string|null $description
 * @property string|null $date_acquired
 * @property string|null $user_id
 * @property Carbon|null $date
 *
 * @package App\Models
 */
class Asset extends Model
{
	protected $table = 'asset';
	public $timestamps = false;

	protected $casts = [
		'date' => 'datetime'
	];

	protected $fillable = [
		'name',
		'class_id',
		'type_id',
		'description',
		'date_acquired',
		'user_id',
		'date'
	];
}
