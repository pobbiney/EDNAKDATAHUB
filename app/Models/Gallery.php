<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Gallery
 * 
 * @property int $id
 * @property string|null $title
 * @property string|null $description
 * @property string|null $photo
 * @property Carbon|null $date
 *
 * @package App\Models
 */
class Gallery extends Model
{
	protected $table = 'gallery';
	public $timestamps = false;

	protected $casts = [
		'date' => 'datetime'
	];

	protected $fillable = [
		'title',
		'description',
		'photo',
		'date'
	];
}
