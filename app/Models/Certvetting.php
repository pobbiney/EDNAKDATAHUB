<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Certvetting
 * 
 * @property int $id
 * @property int $appId
 * @property int $vettedBy
 * @property Carbon $vettedOn
 * @property string|null $comment
 * @property string|null $status
 * @property string|null $reason
 *
 * @package App\Models
 */
class Certvetting extends Model
{
	protected $table = 'certvetting';
	public $timestamps = false;

	protected $casts = [
		'appId' => 'int',
		'vettedBy' => 'int',
		'vettedOn' => 'datetime'
	];

	protected $fillable = [
		'appId',
		'vettedBy',
		'vettedOn',
		'comment',
		'status',
		'reason'
	];
}
