<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Drawingupload
 * 
 * @property int $id
 * @property string|null $path
 * @property string|null $uploadType
 * @property int|null $drawingType
 * @property Carbon $createdOn
 * @property int|null $createdBy
 * @property Carbon|null $updatedOn
 * @property int|null $updatedBy
 * @property int|null $appId
 * @property string|null $formsNumber
 *
 * @package App\Models
 */
class Drawingupload extends Model
{
	protected $table = 'drawinguploads';
	public $timestamps = false;

	protected $casts = [
		'drawingType' => 'int',
		'createdOn' => 'datetime',
		'createdBy' => 'int',
		'updatedOn' => 'datetime',
		'updatedBy' => 'int',
		'appId' => 'int'
	];

	protected $fillable = [
		'path',
		'uploadType',
		'drawingType',
		'createdOn',
		'createdBy',
		'updatedOn',
		'updatedBy',
		'appId',
		'formsNumber'
	];

	public function drawname()
	{
		return $this->belongsTo(Drawing::class, 'drawingType', 'id');  
	
	}
}
