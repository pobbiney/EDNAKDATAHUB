<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class AssetClass
 * 
 * @property int $id
 * @property string|null $name
 * @property string|null $description
 * @property string|null $status
 *
 * @package App\Models
 */
class AssetClass extends Model
{
	protected $table = 'asset_class';
	public $timestamps = false;

	protected $fillable = [
		'name',
		'description',
		'status'
	];
}
