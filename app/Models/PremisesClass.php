<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class PremisesClass
 * 
 * @property int $id
 * @property string|null $name
 * @property string|null $status
 *
 * @package App\Models
 */
class PremisesClass extends Model
{
	protected $table = 'premises_class';
	public $timestamps = false;

	protected $fillable = [
		'name',
		'status'
	];
}
