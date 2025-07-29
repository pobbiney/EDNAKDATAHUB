<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Payment
 * 
 * @property int $id
 * @property string $amount
 * @property string $type
 * @property string $paymentDesc
 * @property int $createdBy
 * @property Carbon|null $createdOn
 * @property int|null $formId
 * @property string|null $payment_mode
 * @property string|null $comment
 *
 * @package App\Models
 */
class Payment extends Model
{
	protected $table = 'payment';
	public $timestamps = false;

	protected $casts = [
		'createdBy' => 'int',
		'createdOn' => 'datetime',
		'formId' => 'int'
	];

	protected $fillable = [
		'amount',
		'type',
		'paymentDesc',
		'createdBy',
		'createdOn',
		'formId',
		'payment_mode',
		'comment'
	];
}
