<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class OtherReport
 * 
 * @property int $id
 * @property string|null $authorizate_id
 * @property string|null $form_type
 * @property string|null $applicant_id
 * @property string|null $fire_cert_displayed
 * @property string|null $fire_cert_displayed_condition
 * @property string|null $fire_cert_displayed_condition_comment
 * @property string|null $safety_management
 * @property string|null $safety_management_condition
 * @property string|null $safety_management_commnet
 * @property string|null $safety_officer
 * @property string|null $safety_officer_condition
 * @property string|null $safety_officer_comment
 * @property string|null $fire_outbreak
 * @property string|null $fire_outbreak_condition
 * @property string|null $fire_outbreak_comment
 * @property string|null $fire_plan
 * @property string|null $fire_plan_condition
 * @property string|null $fire_plan_comment
 * @property string|null $evacuation_plan
 * @property string|null $evacuation_plan_condition
 * @property string|null $evacuation_plan_comment
 * @property string|null $evacuation_drills
 * @property string|null $evacuation_drills_condition
 * @property string|null $evacuation_drills_comment
 * @property string|null $adequate_training
 * @property string|null $adequate_training_condition
 * @property string|null $adequate_training_comment
 * @property string|null $created_on
 * @property string|null $created_by
 *
 * @package App\Models
 */
class OtherReport extends Model
{
	protected $table = 'other_report';
	public $timestamps = false;

	protected $fillable = [
		'authorizate_id',
		'form_type',
		'applicant_id',
		'fire_cert_displayed',
		'fire_cert_displayed_condition',
		'fire_cert_displayed_condition_comment',
		'safety_management',
		'safety_management_condition',
		'safety_management_commnet',
		'safety_officer',
		'safety_officer_condition',
		'safety_officer_comment',
		'fire_outbreak',
		'fire_outbreak_condition',
		'fire_outbreak_comment',
		'fire_plan',
		'fire_plan_condition',
		'fire_plan_comment',
		'evacuation_plan',
		'evacuation_plan_condition',
		'evacuation_plan_comment',
		'evacuation_drills',
		'evacuation_drills_condition',
		'evacuation_drills_comment',
		'adequate_training',
		'adequate_training_condition',
		'adequate_training_comment',
		'created_on',
		'created_by'
	];
}
