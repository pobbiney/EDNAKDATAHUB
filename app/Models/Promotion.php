<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Promotion
 * 
 * @property int $id
 * @property string|null $staffID
 * @property string|null $rank_class
 * @property string|null $current_rank
 * @property string|null $new_rank
 * @property Carbon|null $date
 * @property string|null $created_by
 * @property string|null $approved_by
 * @property string|null $approved_on
 * @property string|null $status
 * @property string|null $reason
 *
 * @package App\Models
 */
class Promotion extends Model
{
	protected $table = 'promotion';
	public $timestamps = false;

	protected $casts = [
		'date' => 'datetime'
	];

	protected $fillable = [
		'staffID',
		'rank_class',
		'current_rank',
		'new_rank',
		'date',
		'created_by',
		'approved_by',
		'approved_on',
		'status',
		'reason'
	];
}
