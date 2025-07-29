<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class StationType
 * 
 * @property int $id
 * @property string|null $name
 * @property string|null $description
 * @property string|null $status
 *
 * @package App\Models
 */
class StationType extends Model
{
	protected $table = 'station_type';
	public $timestamps = false;

	protected $fillable = [
		'name',
		'description',
		'status'
	];
}
