<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class InspectionQuestionType
 * 
 * @property int $id
 * @property string $name
 * @property string|null $description
 * @property string|null $section
 * @property string|null $created_on
 * @property string|null $created_by
 *
 * @package App\Models
 */
class InspectionQuestionType extends Model
{
	protected $table = 'inspection_question_type';
	public $timestamps = false;

	protected $fillable = [
		'name',
		'description',
		'section',
		'created_on',
		'created_by'
	];

	// In InspectionQuestionType model:
	public function questions()
	{
		return $this->hasMany(InspectionQuestion::class, 'type_id', 'id');
	}

 
}
