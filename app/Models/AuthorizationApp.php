<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class AuthorizationApp
 * 
 * @property int $id
 * @property string|null $renew_app_id
 * @property string|null $assigned_officer
 * @property string|null $purpose
 * @property string|null $date
 * @property string|null $created_by
 * @property string|null $created_on
 * @property string|null $applicant_id
 * @property string|null $form_type
 * @property string $inspection_status
 *
 * @package App\Models
 */
class AuthorizationApp extends Model
{
	protected $table = 'authorization_app';
	public $timestamps = false;

	protected $fillable = [
		'renew_app_id',
		'assigned_officer',
		'purpose',
		'date',
		'created_by',
		'created_on',
		'applicant_id',
		'form_type',
		'inspection_status'
	];

	public function appname()
{
	return $this->belongsTo(CertificateApp::class, 'applicant_id', 'id');  
}

	public function pername()
{
	return $this->belongsTo(PermitApp::class, 'applicant_id', 'id');  
}
}
