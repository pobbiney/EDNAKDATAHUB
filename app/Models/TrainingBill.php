<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class TrainingBill
 * 
 * @property int $id
 * @property string|null $trainingid
 * @property string|null $participant_id
 * @property string|null $bill
 * @property string|null $payment
 * @property string|null $bill_by
 * @property string|null $bill_on
 * @property string|null $payment_on
 * @property string|null $payment_by
 * @property string|null $receipt_no
 *
 * @package App\Models
 */
class TrainingBill extends Model
{
	protected $table = 'training_bill';
	public $timestamps = false;

	protected $fillable = [
		'trainingid',
		'participant_id',
		'bill',
		'payment',
		'bill_by',
		'bill_on',
		'payment_on',
		'payment_by',
		'receipt_no'
	];
}
