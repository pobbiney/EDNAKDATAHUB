<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class TrainingClass
 * 
 * @property int $id
 * @property string|null $name
 * @property string|null $description
 *
 * @package App\Models
 */
class TrainingClass extends Model
{
	protected $table = 'training_class';
	public $timestamps = false;

	protected $fillable = [
		'name',
		'description'
	];
}
