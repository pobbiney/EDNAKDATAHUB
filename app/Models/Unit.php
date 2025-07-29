<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Unit
 * 
 * @property int $id
 * @property string|null $name
 * @property string|null $department_id
 * @property string|null $status
 *
 * @package App\Models
 */
class Unit extends Model
{
	protected $table = 'unit';
	public $timestamps = false;

	protected $fillable = [
		'name',
		'department_id',
		'status'
	];
}
