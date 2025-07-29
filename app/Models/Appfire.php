<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Appfire
 * 
 * @property int $id
 * @property int|null $ItemId
 * @property string|null $status
 * @property string|null $number
 * @property string|null $location
 * @property int $applicationId
 *
 * @package App\Models
 */
class Appfire extends Model
{
	protected $table = 'appfire';
	public $timestamps = false;

	protected $casts = [
		'ItemId' => 'int',
		'applicationId' => 'int'
	];

	protected $fillable = [
		'ItemId',
		'status',
		'number',
		'location',
		'applicationId'
	];

	public function appfire()
	{
		return $this->belongsTo(Firefighting::class, 'ItemId' ,'id'); // 'itemID' is the foreign key
	}
}
