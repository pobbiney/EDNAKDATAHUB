<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Permitapproval
 * 
 * @property int $id
 * @property int $appId
 * @property int $createdBy
 * @property string $createdOn
 * @property string|null $comment
 * @property string|null $status
 * @property string|null $region_id
 *
 * @package App\Models
 */
class Permitapproval extends Model
{
	protected $table = 'permitapproval';
	public $timestamps = false;

	protected $casts = [
		'appId' => 'int',
		'createdBy' => 'int'
	];

	protected $fillable = [
		'appId',
		'createdBy',
		'createdOn',
		'comment',
		'status',
		'region_id'
	];
}
