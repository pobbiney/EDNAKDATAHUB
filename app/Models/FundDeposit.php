<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class FundDeposit
 * 
 * @property int $id
 * @property string|null $bank_id
 * @property string|null $cheque_no
 * @property string|null $account_id
 * @property string|null $trans_type
 * @property string|null $expense_type_id
 * @property string|null $fund_source
 * @property string|null $description
 * @property string $dep_amount
 * @property string $dep_status
 * @property string $red_amount
 * @property string $red_status
 * @property string|null $currency
 * @property string|null $trans_by
 * @property string|null $trans_on
 * @property string|null $receipt
 * @property string|null $created_by
 * @property string|null $created_on
 * @property int|null $brc_id
 * @property string|null $approve_by
 * @property string|null $approve_on
 *
 * @package App\Models
 */
class FundDeposit extends Model
{
	protected $table = 'fund_deposit';
	public $timestamps = false;

	protected $casts = [
		'brc_id' => 'int'
	];

	protected $fillable = [
		'bank_id',
		'cheque_no',
		'account_id',
		'trans_type',
		'expense_type_id',
		'fund_source',
		'description',
		'dep_amount',
		'dep_status',
		'red_amount',
		'red_status',
		'currency',
		'trans_by',
		'trans_on',
		'receipt',
		'created_by',
		'created_on',
		'brc_id',
		'approve_by',
		'approve_on'
	];
}
