<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Floortable
 * 
 * @property int $id
 * @property int $floorNumber
 * @property string|null $length
 * @property string|null $breadth
 * @property int $applicationId
 * @property string $applicationType
 *
 * @package App\Models
 */
class Floortable extends Model
{
	protected $table = 'floortable';
	public $timestamps = false;

	protected $casts = [
		'floorNumber' => 'int',
		'applicationId' => 'int'
	];

	protected $fillable = [
		'floorNumber',
		'length',
		'breadth',
		'applicationId',
		'applicationType'
	];
}
