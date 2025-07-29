<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Tracker
 * 
 * @property int $id
 * @property string|null $formID
 * @property string|null $activity
 * @property string|null $createdOn
 * @property string|null $createdBy
 * @property string|null $activity_type
 * @property string|null $regionId
 *
 * @package App\Models
 */
class Tracker extends Model
{
	protected $table = 'tracker';
	public $timestamps = false;

	protected $fillable = [
		'formID',
		'activity',
		'createdOn',
		'createdBy',
		'activity_type',
		'regionId'
	];

	public function formsale()
{
    return $this->belongsTo(Formsale::class, 'formID');
}

public function activityname()
{
    return $this->belongsTo(Activity::class, 'activity'); // Adjust as per your relationship

	
}

public function staff()
{
    return $this->belongsTo(Staff::class, 'createdBy' ,'staff_id'); // Adjust as per your relationship

	
}
}
