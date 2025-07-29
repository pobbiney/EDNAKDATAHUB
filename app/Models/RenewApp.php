<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class RenewApp
 * 
 * @property int $id
 * @property string $cert_id
 * @property string|null $floors
 * @property string|null $current_use
 * @property string|null $cont_person
 * @property string|null $mobile
 * @property string|null $email
 * @property string $createdby
 * @property string $createdon
 * @property string $status
 * @property string|null $form_type
 *
 * @package App\Models
 */
class RenewApp extends Model
{
	protected $table = 'renew_app';
	public $timestamps = false;

	protected $fillable = [
		'cert_id',
		'floors',
		'current_use',
		'cont_person',
		'mobile',
		'email',
		'createdby',
		'createdon',
		'status',
		'form_type'
	];

	function premises(){
        return $this->belongsTo(Businesstype::class, 'current_use','id');
    }

	 
}
