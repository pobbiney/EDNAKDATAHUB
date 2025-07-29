<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class FirmProfile
 * 
 * @property int $id
 * @property string|null $company_name
 * @property string|null $logo
 * @property string|null $company_address
 * @property string|null $company_website
 * @property string|null $email
 * @property string|null $company_phone
 * @property string|null $fax
 * @property string|null $return_policy
 *
 * @package App\Models
 */
class FirmProfile extends Model
{
	protected $table = 'firm_profile';
	public $timestamps = false;

	protected $fillable = [
		'company_name',
		'logo',
		'company_address',
		'company_website',
		'email',
		'company_phone',
		'fax',
		'return_policy'
	];
}
