<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Changerequest
 * 
 * @property int $id
 * @property string $description
 * @property string $requestType
 * @property int $requestTypeId
 * @property string $status
 * @property int $createdBy
 * @property Carbon $createdOn
 * @property int|null $approvedBy
 * @property Carbon|null $approvedOn
 * @property string|null $comments
 *
 * @package App\Models
 */
class Changerequest extends Model
{
	protected $table = 'changerequest';
	public $timestamps = false;

	protected $casts = [
		'requestTypeId' => 'int',
		'createdBy' => 'int',
		'createdOn' => 'datetime',
		'approvedBy' => 'int',
		'approvedOn' => 'datetime'
	];

	protected $fillable = [
		'description',
		'requestType',
		'requestTypeId',
		'status',
		'createdBy',
		'createdOn',
		'approvedBy',
		'approvedOn',
		'comments'
	];

	public function staff()
	{
		return $this->belongsTo(Staff::class, 'createdBy', 'staff_id'); 
	}
	public function users()
	{
		return $this->belongsTo(Staff::class, 'approvedBy', 'staff_id'); 
	}
}
