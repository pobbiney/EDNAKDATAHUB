<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class RegBrief
 * 
 * @property int $id
 * @property string|null $region_id
 * @property string|null $staff_id
 * @property string|null $reg_history
 * @property string|null $about_reg
 * @property string|null $strength
 * @property string|null $location
 * @property string|null $gps
 * @property string|null $tel
 * @property string|null $status
 * @property string|null $created_by
 * @property Carbon|null $created_on
 * @property string|null $updated_by
 * @property Carbon|null $updated_on
 *
 * @package App\Models
 */
class RegBrief extends Model
{
	protected $table = 'reg_brief';
	public $timestamps = false;

	protected $casts = [
		'created_on' => 'datetime',
		'updated_on' => 'datetime'
	];

	protected $fillable = [
		'region_id',
		'staff_id',
		'reg_history',
		'about_reg',
		'strength',
		'location',
		'gps',
		'tel',
		'status',
		'created_by',
		'created_on',
		'updated_by',
		'updated_on'
	];
	function staff(){
        return $this->belongsTo(Staff::class, 'staff_id','staff_id');
    }
	function region(){
        return $this->belongsTo(Region::class, 'region_id','id');
    }
}
