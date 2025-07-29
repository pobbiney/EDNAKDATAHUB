<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class PremisesType
 * 
 * @property int $id
 * @property string|null $name
 * @property string|null $class_id
 * @property string|null $status
 *
 * @package App\Models
 */
class PremisesType extends Model
{
	protected $table = 'premises_type';
	public $timestamps = false;

	protected $fillable = [
		'name',
		'class_id',
		'status'
	];
}
