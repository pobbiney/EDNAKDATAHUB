<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Management
 * 
 * @property int $id
 * @property string|null $name
 * @property string|null $position
 * @property string|null $work_details
 * @property string|null $image
 * @property string|null $year
 * @property string|null $dept_id
 *
 * @package App\Models
 */
class Management extends Model
{
	protected $table = 'management';
	public $timestamps = false;

	protected $fillable = [
		'name',
		'position',
		'work_details',
		'image',
		'year',
		'dept_id'
	];
}
