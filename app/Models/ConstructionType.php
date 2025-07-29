<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class ConstructionType
 * 
 * @property int $id
 * @property string $name
 * @property string|null $description
 * @property string $status
 * @property int $createdBy
 * @property Carbon $createdOn
 * @property int|null $updatedBy
 * @property Carbon|null $updatedOn
 *
 * @package App\Models
 */
class ConstructionType extends Model
{
	protected $table = 'construction_type';
	public $timestamps = false;

	protected $casts = [
		'createdBy' => 'int',
		'createdOn' => 'datetime',
		'updatedBy' => 'int',
		'updatedOn' => 'datetime'
	];

	protected $fillable = [
		'name',
		'description',
		'status',
		'createdBy',
		'createdOn',
		'updatedBy',
		'updatedOn'
	];
}
