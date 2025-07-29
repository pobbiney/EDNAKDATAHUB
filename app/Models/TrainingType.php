<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class TrainingType
 * 
 * @property int $id
 * @property string|null $name
 * @property string|null $description
 * @property string|null $class_id
 *
 * @package App\Models
 */
class TrainingType extends Model
{
	protected $table = 'training_type';
	public $timestamps = false;

	protected $fillable = [
		'name',
		'description',
		'class_id'
	];
}
