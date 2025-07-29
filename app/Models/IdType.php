<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class IdType
 * 
 * @property int $id
 * @property string|null $name
 * @property string|null $description
 * @property int|null $created_by
 * @property Carbon|null $created_on
 * @property Carbon|null $update_on
 *
 * @package App\Models
 */
class IdType extends Model
{
	protected $table = 'id_type';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'id' => 'int',
		'created_by' => 'int',
		'created_on' => 'datetime',
		'update_on' => 'datetime'
	];

	protected $fillable = [
		'name',
		'description',
		'created_by',
		'created_on',
		'update_on'
	];
}
