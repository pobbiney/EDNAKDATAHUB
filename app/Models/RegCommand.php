<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class RegCommand
 * 
 * @property int $id
 * @property string|null $staffID
 * @property string|null $region_id
 * @property string|null $profile
 * @property string|null $education
 * @property string|null $work
 * @property string|null $courses
 * @property string|null $dob
 * @property string|null $marital_status
 * @property string|null $number_children
 * @property string|null $hobbies
 * @property string|null $image
 * @property string|null $status
 * @property string|null $created_by
 * @property Carbon|null $created_on
 * @property string|null $updatedby
 * @property Carbon|null $updatedon
 *
 * @package App\Models
 */
class RegCommand extends Model
{
	protected $table = 'reg_command';
	public $timestamps = false;

	protected $casts = [
		'created_on' => 'datetime',
		'updatedon' => 'datetime'
	];

	protected $fillable = [
		'staffID',
		'region_id',
		'profile',
		'education',
		'work',
		'courses',
		'dob',
		'marital_status',
		'number_children',
		'hobbies',
		'image',
		'status',
		'created_by',
		'created_on',
		'updatedby',
		'updatedon'
	];

	function staff(){
        return $this->belongsTo(Staff::class, 'staffID','staff_id');
    }
	function region(){
        return $this->belongsTo(Region::class, 'region_id','id');
    }
	function rank_name(){
        return $this->belongsTo(Rank::class, 'rank','id');
    }
}

