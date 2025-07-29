<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class PermitApp
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
 * @property string $status
 * @property Carbon $createdOn
 * @property int $createdBy
 * @property Carbon|null $updatedOn
 * @property int|null $updatedBy
 * @property int|null $buildingType
 * @property int|null $formId
 * @property string|null $risk
 * @property string|null $recommended
 * @property string|null $reason
 * @property string|null $approveFor
 * @property string|null $companyName
 * @property int|null $businesstype
 * @property int|null $businessClass
 * @property string|null $amountPaid
 * @property string|null $amount
 * @property string|null $serial_number
 * @property string|null $formType
 * @property string|null $permit_number
 * @property string|null $date_issue
 *
 * @package App\Models
 */
class PermitApp extends Model
{
	protected $table = 'permit_app';
	public $timestamps = false;

	protected $casts = [
		'buildType' => 'int',
		'noFloor' => 'int',
		'createdOn' => 'datetime',
		'createdBy' => 'int',
		'updatedOn' => 'datetime',
		'updatedBy' => 'int',
		'buildingType' => 'int',
		'formId' => 'int',
		'businesstype' => 'int',
		'businessClass' => 'int'
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
		'status',
		'createdOn',
		'createdBy',
		'updatedOn',
		'updatedBy',
		'buildingType',
		'formId',
		'risk',
		'recommended',
		'reason',
		'approveFor',
		'companyName',
		'businesstype',
		'businessClass',
		'amountPaid',
		'amount',
		'serial_number',
		'formType',
		'permit_number',
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

 

	public function req()
{
	return $this->hasMany(Changerequest::class, 'requestTypeId', 'id'); // Adjust if your FK is different
}

public function issuance()
    {
        return $this->hasOne(CertIssuance::class, 'app_id', 'id');
    }
	 
}
