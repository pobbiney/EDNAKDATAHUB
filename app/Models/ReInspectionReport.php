<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class ReInspectionReport
 * 
 * @property int $id
 * @property string $authorizate_id
 * @property string $applicant_id
 * @property string $form_type
 * @property string $section
 * @property string $question_type_id
 * @property string $question_id
 * @property string|null $response
 * @property string|null $condition
 * @property string|null $comment
 * @property string|null $tick
 * @property string|null $number
 * @property string|null $location
 * @property string|null $created_on
 * @property string|null $created_by
 *
 * @package App\Models
 */
class ReInspectionReport extends Model
{
	protected $table = 're_inspection_report';
	public $timestamps = false;

	protected $fillable = [
		'authorizate_id',
		'applicant_id',
		'form_type',
		'section',
		'question_type_id',
		'question_id',
		'response',
		'condition',
		'comment',
		'tick',
		'number',
		'location',
		'created_on',
		'created_by'
	];

	// ReInspectionReport.php
public function question()
{
    return $this->belongsTo(InspectionQuestion::class, 'question_id');
}
}
