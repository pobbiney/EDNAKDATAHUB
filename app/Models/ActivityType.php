<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class ActivityType
 * 
 * @property int $id
 * @property string|null $name
 * @property string|null $status
 *
 * @package App\Models
 */
class ActivityType extends Model
{
	protected $table = 'activity_type';
	public $timestamps = false;

	protected $fillable = [
		'name',
		'status'
	];
}
