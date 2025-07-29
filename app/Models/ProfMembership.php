<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class ProfMembership
 * 
 * @property int $id
 * @property string|null $staff_id
 * @property string|null $institution
 * @property string|null $mem_type
 * @property string|null $enrol_year
 * @property string|null $created_on
 * @property string|null $created_by
 *
 * @package App\Models
 */
class ProfMembership extends Model
{
	protected $table = 'prof_membership';
	public $timestamps = false;

	protected $fillable = [
		'staff_id',
		'institution',
		'mem_type',
		'enrol_year',
		'created_on',
		'created_by'
	];
}
