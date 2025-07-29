<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class TrainingPart
 * 
 * @property int $id
 * @property string|null $training_id
 * @property string|null $staff_id
 * @property string|null $name
 * @property string|null $email
 * @property int|null $phone
 * @property string|null $instit
 * @property string|null $gender
 * @property int|null $brc_id
 * @property string|null $participant_id
 * @property string|null $createdby
 * @property string|null $createdon
 * @property string|null $updatedon
 *
 * @package App\Models
 */
class TrainingPart extends Model
{
	protected $table = 'training_part';
	public $timestamps = false;

	protected $casts = [
		'phone' => 'int',
		'brc_id' => 'int'
	];

	protected $fillable = [
		'training_id',
		'staff_id',
		'name',
		'email',
		'phone',
		'instit',
		'gender',
		'brc_id',
		'participant_id',
		'createdby',
		'createdon',
		'updatedon'
	];
}
