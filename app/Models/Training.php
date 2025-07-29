<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Training
 * 
 * @property int $id
 * @property string|null $name
 * @property string $description
 * @property string|null $objectives
 * @property string|null $class_id
 * @property string|null $type_id
 * @property string|null $venu
 * @property string|null $start_date
 * @property string|null $end_date
 * @property string|null $participation_fee
 * @property string|null $sponsor
 * @property string|null $createdby
 * @property string|null $createdon
 * @property string|null $updatedon
 * @property int|null $brc_id
 *
 * @package App\Models
 */
class Training extends Model
{
	protected $table = 'training';
	public $timestamps = false;

	protected $casts = [
		'brc_id' => 'int'
	];

	protected $fillable = [
		'name',
		'description',
		'objectives',
		'class_id',
		'type_id',
		'venu',
		'start_date',
		'end_date',
		'participation_fee',
		'sponsor',
		'createdby',
		'createdon',
		'updatedon',
		'brc_id'
	];
}
