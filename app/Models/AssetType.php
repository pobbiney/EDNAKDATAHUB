<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class AssetType
 * 
 * @property int $id
 * @property string|null $name
 * @property string|null $class_id
 * @property string|null $status
 *
 * @package App\Models
 */
class AssetType extends Model
{
	protected $table = 'asset_type';
	public $timestamps = false;

	protected $fillable = [
		'name',
		'class_id',
		'status'
	];
}
