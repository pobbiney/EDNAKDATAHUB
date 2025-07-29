<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Currency
 * 
 * @property int $id
 * @property string $name
 * @property string|null $description
 * @property int $status
 *
 * @package App\Models
 */
class Currency extends Model
{
	protected $table = 'currency';
	public $timestamps = false;

	protected $casts = [
		'status' => 'int'
	];

	protected $fillable = [
		'name',
		'description',
		'status'
	];
}
