<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class ContactU
 * 
 * @property int $id
 * @property string|null $name
 * @property string|null $email
 * @property string|null $phone
 * @property string|null $subject
 * @property string|null $message
 *
 * @package App\Models
 */
class ContactU extends Model
{
	protected $table = 'contact_us';
	public $timestamps = false;

	protected $fillable = [
		'name',
		'email',
		'phone',
		'subject',
		'message'
	];
}
