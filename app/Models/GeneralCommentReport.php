<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class GeneralCommentReport
 * 
 * @property int $id
 * @property string|null $authorizate_id
 * @property string|null $applicant_id
 * @property string|null $form_type
 * @property string|null $section
 * @property string|null $rate
 * @property string|null $recommend
 * @property string|null $comment
 * @property string|null $created_on
 * @property string|null $created_by
 *
 * @package App\Models
 */
class GeneralCommentReport extends Model
{
	protected $table = 'general_comment_report';
	public $timestamps = false;

	protected $fillable = [
		'authorizate_id',
		'applicant_id',
		'form_type',
		'section',
		'rate',
		'recommend',
		'comment',
		'created_on',
		'created_by'
	];
}
