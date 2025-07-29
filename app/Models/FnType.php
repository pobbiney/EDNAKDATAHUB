<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class FnType
 * 
 * @property int $id
 * @property string $name
 * @property string $description
 * @property string $status
 * @property int $category
 * @property int $created_by
 * @property Carbon $date_created
 *
 * @package App\Models
 */
class FnType extends Model
{
	protected $table = 'fn_type';
	public $timestamps = false;

	protected $casts = [
		'category' => 'int',
		'created_by' => 'int',
		'date_created' => 'datetime'
	];

	protected $fillable = [
		'name',
		'description',
		'status',
		'category',
		'created_by',
		'date_created'
	];
}
