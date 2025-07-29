<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Slider
 * 
 * @property int $id
 * @property string|null $title
 * @property string|null $description
 * @property string|null $link
 * @property string|null $image
 *
 * @package App\Models
 */
class Slider extends Model
{
	protected $table = 'slider';
	public $timestamps = false;

	protected $fillable = [
		'title',
		'description',
		'link',
		'image'
	];
}
