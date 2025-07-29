<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class ServiceProvider
 * 
 * @property int $id
 * @property string|null $bus_name
 * @property string|null $class_id
 * @property string|null $type_id
 * @property string|null $inc_year
 * @property string|null $TIN
 * @property string|null $ser_des
 * @property string|null $address
 * @property string|null $location
 * @property string|null $region
 * @property string|null $district
 * @property string|null $town
 * @property string|null $tel
 * @property string|null $mobile
 * @property string|null $email
 * @property string|null $website
 * @property string|null $ceo
 * @property string|null $createdby
 * @property Carbon|null $createdon
 * @property string|null $status
 * @property string|null $license_no
 * @property string|null $comment
 *
 * @package App\Models
 */
class ServiceProvider extends Model
{
	protected $table = 'service_provider';
	public $timestamps = false;

	protected $casts = [
		'createdon' => 'datetime'
	];

	protected $fillable = [
		'bus_name',
		'class_id',
		'type_id',
		'inc_year',
		'TIN',
		'ser_des',
		'address',
		'location',
		'region',
		'district',
		'town',
		'tel',
		'mobile',
		'email',
		'website',
		'ceo',
		'createdby',
		'createdon',
		'status',
		'license_no',
		'comment'
	];
}
