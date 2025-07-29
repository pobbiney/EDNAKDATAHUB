<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class CertificateApp
 * 
 * @property int $id
 * @property string $surname
 * @property string $firstname
 * @property string|null $othername
 * @property string|null $plotNo
 * @property string|null $location
 * @property string|null $city
 * @property string|null $region
 * @property string|null $district
 * @property string|null $address
 * @property string|null $mobile
 * @property string|null $tel
 * @property string|null $email
 * @property int|null $buildType
 * @property int|null $noFloor
 * @property int|null $constType
 * @property string|null $previousUse
 * @property string|null $currentUse
 * @property string|null $proposedUse
 * @property Carbon|null $constructionDate
 * @property int|null $noOccupants
 * @property string $status
 * @property int $createdBy
 * @property Carbon $createdOn
 * @property Carbon|null $updatedOn
 * @property int|null $updatedBy
 * @property int|null $buildingType
 * @property int|null $formId
 * @property string|null $risk
 * @property string|null $recommended
 * @property string|null $reason
 * @property string|null $approveFor
 * @property string|null $companyName
 * @property int|null $businessClass
 * @property int|null $businessType
 * @property string|null $amountPaid
 * @property string|null $amount
 * @property string|null $serial_number
 * @property string|null $formType
 * @property string|null $certificate_number
 * @property string|null $date_issue
 *
 * @package App\Models
 */
class CertificateApp extends Model
{
	protected $table = 'certificate_app';
	public $timestamps = false;

	protected $casts = [
		'buildType' => 'int',
		'noFloor' => 'int',
		'constType' => 'int',
		'constructionDate' => 'datetime',
		'noOccupants' => 'int',
		'createdBy' => 'int',
		'createdOn' => 'datetime',
		'updatedOn' => 'datetime',
		'updatedBy' => 'int',
		'buildingType' => 'int',
		'formId' => 'int',
		'businessClass' => 'int',
		'businessType' => 'int'
	];

	protected $fillable = [
		'surname',
		'firstname',
		'othername',
		'plotNo',
		'location',
		'city',
		'region',
		'district',
		'address',
		'mobile',
		'tel',
		'email',
		'buildType',
		'noFloor',
		'constType',
		'previousUse',
		'currentUse',
		'proposedUse',
		'constructionDate',
		'noOccupants',
		'status',
		'createdBy',
		'createdOn',
		'updatedOn',
		'updatedBy',
		'buildingType',
		'formId',
		'risk',
		'recommended',
		'reason',
		'approveFor',
		'companyName',
		'businessClass',
		'businessType',
		'amountPaid',
		'amount',
		'serial_number',
		'formType',
		'certificate_number',
		'date_issue'
	];

	public function tasks()
{
	return $this->hasMany(Task::class, 'taskId', 'id'); // Adjust if your FK is different
}
	public function reg()
{
	return $this->belongsTo(Region::class, 'region', 'id');  
}
	public function dist()

{
	return $this->belongsTo(District::class, 'district', 'id'); 

}
public function buildtypes()
{
	return $this->belongsTo(Buildingtype::class, 'buildType', 'id');  

}
public function constTypes()
{
	return $this->belongsTo(ConstructionType::class, 'constType', 'id');  

}

public function req()
{
	return $this->hasMany(Changerequest::class, 'requestTypeId', 'id'); // Adjust if your FK is different
}

public function checkMeansEscape($typeId, $id){
	$checker = Applicationmeansofescape::where([['meansOfEscapeId',$typeId],['appId',$id]])->get()->count();

	if($checker > 0){

		return true;
	}else{

		return false;
	}
}

public function checkApplicationFire($typeId, $id){
	$checker = Applicationfirefighting::where([['fireFightingId',$typeId],['appId',$id]])->get()->count();

	if($checker > 0){

		return true;
	}else{

		return false;
	}
}

public function checkAccessRoute($typeId, $id){
	$checker = Applicationaccessroute::where([['accessRouteId',$typeId],['appId',$id]])->get()->count();

	if($checker > 0){

		return true;
	}else{

		return false;
	}
}

public function checkSetupWarningDevices($typeId, $id){
	
	$checker = Applicationwarningdevice::where([['warningDeviceId',$typeId],['appId',$id]])->get()->count();

	if($checker > 0){

		return true;
	}else{

		return false;
	}
}

 public function drawingUploads()
{
    return $this->hasMany(DrawingUpload::class, 'appId');
}
	 
public function prevuse()
{
	return $this->belongsTo(Businesstype::class, 'previousUse', 'id');  

}

public function curentuse()
{
	return $this->belongsTo(Businesstype::class, 'currentUse', 'id');  

}

public function proposeuse()
{
	return $this->belongsTo(Businesstype::class, 'proposedUse', 'id');  

}

public function issuance()
    {
        return $this->hasOne(CertIssuance::class, 'app_id', 'id');
    }
}
