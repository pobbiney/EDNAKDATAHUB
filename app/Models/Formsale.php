<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Formsale
 * 
 * @property int $id
 * @property string|null $applicantName
 * @property string $tell
 * @property int $formType
 * @property int $createdBy
 * @property Carbon|null $createdOn
 * @property string $status
 * @property string|null $serialNumber
 * @property string|null $pin
 * @property string|null $formNumber
 * @property int|null $regionId
 * @property string|null $amountPaid
 * @property string $password
 * @property string|null $email
 * @property string|null $location
 *
 * @package App\Models
 */
class Formsale extends Model
{
	protected $table = 'formsales';
	public $timestamps = false;

	protected $casts = [
		'formType' => 'int',
		'createdBy' => 'int',
		'createdOn' => 'datetime',
		'regionId' => 'int'
	];

	protected $hidden = [
		'password'
	];

	protected $fillable = [
		'applicantName',
		'tell',
		'formType',
		'createdBy',
		'createdOn',
		'status',
		'serialNumber',
		'pin',
		'formNumber',
		'regionId',
		'amountPaid',
		'password',
		'email',
		'location',
		'permit_type'
	];

	public function formTypeDetails (){

		if(Applicationform::where('id',$this->formType)->get()->count() > 0){

			return Applicationform::find($this->formType);


		}else{

			return null;
		}
	}

	public function createdByName (){

		if(User::where('id',$this->createdBy)->get()->count() > 0){

			return User::find($this->createdBy)->name;

		}else{

			return "Not Available";
		}
	}
	public function regs()
	{
		return $this->belongsTo(Region::class, 'regionId', 'id');  
	}

	public function formtype()
	{
		return $this->belongsTo(Applicationform::class, 'formType', 'id');  
	}

	public function hasRecords(){

		if(CertificateApp::where('formId',$this->id)->get()->count() > 0){

			return true;

		}else{

			return false;
		}
	}

		public function hasPermitRecords(){

		if(PermitApp::where('formId',$this->id)->get()->count() > 0){

			return true;

		}else{

			return false;
		}
	}

	public function checkType (){

		if($this->formType == 2){

			return PermitApp::where('formId',$this->id)->get();

		}else{

			return CertificateApp::where('formId',$this->id)->get();


		}
	}

	public function certificates()
	{
		return $this->hasMany(CertificateApp::class, 'formId');
	}

	public function trackers()
	{
		return $this->hasMany(Tracker::class, 'formID');
	}

	public function permit_registrations()
	{
		return $this->hasOne(PermitRegistration::class, 'formID');
	}

	public function currentStage()
	{
		return $this->hasOne(Tracker::class, 'formID')->latestOfMany();
	}
}
