<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Director
 * 
 * @property int $id
 * @property string|null $sme_id
 * @property string|null $surname
 * @property string|null $firstname
 * @property string|null $id_type
 * @property string|null $id_number
 * @property string|null $work_mobile
 * @property string|null $work_email
 * @property string|null $nationality
 * @property string|null $id_card
 * @property string|null $createdby
 * @property Carbon|null $date
 * @property string|null $updatedby
 * @property Carbon|null $updatedon
 *
 * @package App\Models
 */
class Director extends Model
{
	protected $table = 'directors';
	public $timestamps = false;

	protected $casts = [
		'date' => 'datetime',
		'updatedon' => 'datetime'
	];

	protected $fillable = [
		'sme_id',
		'surname',
		'firstname',
		'id_type',
		'id_number',
		'work_mobile',
		'work_email',
		'nationality',
		'id_card',
		'createdby',
		'date',
		'updatedby',
		'updatedon'
	];
}
