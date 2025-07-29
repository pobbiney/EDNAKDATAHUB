<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Appalarm
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
class Appalarm extends Model
{
	protected $table = 'appalarm';
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

	public function appalarm()
	{
		return $this->belongsTo(Alarmandwarning::class, 'ItemId' ,'id'); // 'itemID' is the foreign key
	}
}
