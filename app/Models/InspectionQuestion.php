<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class InspectionQuestion
 * 
 * @property int $id
 * @property string $question
 * @property string $type_id
 * @property string|null $created_on
 * @property string|null $created_by
 *
 * @package App\Models
 */
class InspectionQuestion extends Model
{
	protected $table = 'inspection_questions';
	public $timestamps = false;

	protected $fillable = [
		'question',
		'type_id',
		'created_on',
		'created_by'
	];

	public function qtname()
	{
		return $this->belongsTo(InspectionQuestionType::class, 'type_id', 'id');  
	
	}
	// InspectionQuestion.php
public function responses()
{
    return $this->hasMany(ReInspectionReport::class, 'question_id');
}
	
 
}
