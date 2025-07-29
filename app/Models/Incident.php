<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Incident
 * 
 * @property int $id
 * @property string|null $region_id
 * @property string|null $district_id
 * @property string|null $class_id
 * @property string|null $type_id
 * @property string|null $narration
 * @property string|null $user_id
 * @property Carbon|null $date
 *
 * @package App\Models
 */
class Incident extends Model
{
	protected $table = 'incident';
	public $timestamps = false;

	protected $casts = [
		'date' => 'datetime'
	];

	protected $fillable = [
		'region_id',
		'district_id',
		'class_id',
		'type_id',
		'narration',
		'user_id',
		'date',
		'location',
		'cat_id',
		'full_name',
		'contact_no'
	];

	public function region()
	{
		return $this->belongsTo(Region::class, 'region_id', 'id'); // Adjust if your FK is different
	}

	public function images()
    {
        return $this->hasMany(IncidentImage::class);
    }

	public function tasks()
	{
		return $this->hasMany(IncidentTask::class, 'incident_id', 'id'); // Adjust if your FK is different
	}

	public function report()
	{
		return $this->hasMany(IncidentReport::class, 'incident_id', 'id'); // Adjust if your FK is different
	}

	public function photo()
	{
		return $this->hasMany(IncidentImage::class, 'incident_id', 'id'); // Adjust if your FK is different
	}

	public function typename()
	{
		return $this->belongsTo(IncidentType::class, 'type_id', 'id'); // Adjust if your FK is different
	}

	public function category()
	{
		return $this->belongsTo(IncidentCategory::class, 'cat_id', 'id'); // Adjust if your FK is different
	}
}
