<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class AssetAssignment
 * 
 * @property int $id
 * @property string|null $asset_id
 * @property string|null $region_id
 * @property string|null $district_id
 * @property string|null $assigned_by
 * @property Carbon|null $assigned_on
 *
 * @package App\Models
 */
class AssetAssignment extends Model
{
	protected $table = 'asset_assignment';
	public $timestamps = false;

	protected $casts = [
		'assigned_on' => 'datetime'
	];

	protected $fillable = [
		'asset_id',
		'region_id',
		'district_id',
		'assigned_by',
		'assigned_on'
	];
}
