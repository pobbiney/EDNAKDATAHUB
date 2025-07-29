<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class CertIssuance
 * 
 * @property int $id
 * @property string|null $app_id
 * @property string|null $fullname
 * @property string|null $tel
 * @property string|null $email
 * @property string|null $address
 * @property string|null $issuedate
 * @property string|null $region_id
 * @property string|null $formtype
 * @property Carbon|null $created_on
 * @property string|null $created_by
 * @property string|null $month
 * @property string|null $year
 *
 * @package App\Models
 */
class CertIssuance extends Model
{
	protected $table = 'cert_issuance';
	public $timestamps = false;

	protected $casts = [
		'created_on' => 'datetime'
	];

	protected $fillable = [
		'app_id',
		'fullname',
		'tel',
		'email',
		'address',
		'issuedate',
		'region_id',
		'formtype',
		'created_on',
		'created_by',
		'month',
		'year'
	];

	public function app()
    {
        return $this->belongsTo(CertificateApp::class, 'app_id', 'id');
    }

	public function apps()
    {
        return $this->belongsTo(PermitApp::class, 'app_id', 'id');
    }
}
