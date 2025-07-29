<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class FnClassification
 * 
 * @property int $id
 * @property string $name
 * @property string|null $description
 * @property string|null $status
 * @property int $created_by
 * @property Carbon $date_created
 *
 * @package App\Models
 */
class FnClassification extends Model
{
	protected $table = 'fn_classification';
	public $timestamps = false;

	protected $casts = [
		'created_by' => 'int',
		'date_created' => 'datetime'
	];

	protected $fillable = [
		'name',
		'description',
		'status',
		'created_by',
		'date_created'
	];
}
