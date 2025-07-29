<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Statistic
 * 
 * @property int $id
 * @property string|null $year
 * @property string|null $figure
 * @property string|null $region
 *
 * @package App\Models
 */
class Statistic extends Model
{
	protected $table = 'statistics';
	public $timestamps = false;

	protected $fillable = [
		'year',
		'figure',
		'region'
	];
}
