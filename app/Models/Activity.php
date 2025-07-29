<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Activity
 * 
 * @property int $id
 * @property string|null $activity
 * @property string|null $activity_type
 * @property string|null $description
 * @property string|null $status
 * @property string|null $updatedby
 * @property string|null $updated_on
 * @property string|null $createdby
 * @property string|null $createdon
 *
 * @package App\Models
 */
class Activity extends Model
{
	protected $table = 'activity';
	public $timestamps = false;

	protected $fillable = [
		'activity',
		'activity_type',
		'description',
		'status',
		'updatedby',
		'updated_on',
		'createdby',
		'createdon'
	];

	public function getType (){

		if(ActivityType::where('id',$this->activity_type)->get()->count() > 0){

			return ActivityType::find($this->activity_type)->name;
		}else{

			return "N?A";
		}
	}
}
