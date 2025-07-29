<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Formsaleinvoicedetail
 * 
 * @property int $id
 * @property string|null $forms_id
 * @property string|null $invoice_number
 * @property string|null $invoice_expires
 * @property string|null $total_amount
 * @property string|null $total_amount_ccy
 * @property string|null $service_name
 * @property string|null $service_code
 * @property string|null $created_by
 * @property string $status
 * @property string|null $application_id
 *
 * @package App\Models
 */
class Formsaleinvoicedetail extends Model
{
	protected $table = 'formsaleinvoicedetails';
	public $timestamps = false;

	protected $fillable = [
		'forms_id',
		'invoice_number',
		'invoice_expires',
		'total_amount',
		'total_amount_ccy',
		'service_name',
		'service_code',
		'created_by',
		'status',
		'application_id'
	];
}
