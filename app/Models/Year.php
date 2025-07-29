<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Year
 * 
 * @property int $id
 * @property string|null $year
 *
 * @package App\Models
 */
class Year extends Model
{
	protected $table = 'year';
	public $timestamps = false;

	protected $fillable = [
		'year'
	];
}
