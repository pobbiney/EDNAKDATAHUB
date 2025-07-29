<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class BillFormAssignment
 * 
 * @property int $id
 * @property int $formId
 * @property int $billItemId
 * @property string $status
 * @property int $createdBy
 * @property Carbon|null $createdOn
 * @property int|null $approvedBy
 * @property Carbon|null $approvedOn
 * @property int|null $declinedBy
 * @property Carbon|null $declinedOn
 * @property string|null $declineReason
 *
 * @package App\Models
 */
class BillFormAssignment extends Model
{
	protected $table = 'bill_form_assignment';
	public $timestamps = false;

	protected $casts = [
		'formId' => 'int',
		'billItemId' => 'int',
		'createdBy' => 'int',
		'createdOn' => 'datetime',
		'approvedBy' => 'int',
		'approvedOn' => 'datetime',
		'declinedBy' => 'int',
		'declinedOn' => 'datetime'
	];

	protected $fillable = [
		'formId',
		'billItemId',
		'status',
		'createdBy',
		'createdOn',
		'approvedBy',
		'approvedOn',
		'declinedBy',
		'declinedOn',
		'declineReason'
	];
}
