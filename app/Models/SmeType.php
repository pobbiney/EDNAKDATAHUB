<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class SmeType
 * 
 * @property int $id
 * @property string|null $name_type
 * @property string|null $category_id
 * @property string|null $status
 *
 * @package App\Models
 */
class SmeType extends Model
{
	protected $table = 'sme_type';
	public $timestamps = false;

	protected $fillable = [
		'name_type',
		'category_id',
		'status'
	];
}
