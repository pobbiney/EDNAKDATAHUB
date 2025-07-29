<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Appmeansofescape
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
class Appmeansofescape extends Model
{
	protected $table = 'appmeansofescape';
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

	public function meansofescape()
{
    return $this->belongsTo(Meansofescape::class, 'ItemId'); // 'itemID' is the foreign key
}
}
