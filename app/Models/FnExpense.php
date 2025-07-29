<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class FnExpense
 * 
 * @property int $id
 * @property string|null $name
 * @property string|null $description
 * @property string|null $amount
 * @property string|null $payment_mode
 * @property string|null $type
 * @property string|null $comment
 * @property string|null $cash_comment
 * @property string|null $paid_to
 * @property string|null $created_by
 * @property string|null $trancsation_date
 * @property Carbon|null $date_created
 * @property string|null $receipt
 * @property string|null $brc_id
 * @property string|null $fund_source
 * @property string|null $bank
 * @property string|null $account
 * @property string|null $time_select
 * @property string|null $date_select
 * @property string|null $receivables
 * @property string|null $request_id
 * @property string|null $receiptfrom
 * @property string|null $receiptdate
 * @property string|null $receiptfile
 * @property string|null $receiptamount
 * @property string|null $collectedby
 * @property string|null $createdby
 * @property string|null $datecreated
 * @property string|null $chequeNo
 * @property string|null $pay_no
 * @property string|null $requestby
 * @property string|null $requeston
 * @property string $status
 * @property string|null $authorizedby
 * @property string|null $authorisedon
 * @property string|null $voucher_id
 * @property string|null $file
 * @property string|null $appliedby
 * @property string $approve_status
 * @property string|null $appliedon
 * @property string|null $approvedby
 * @property string|null $approvedon
 * @property string|null $issue_to
 * @property string|null $date_issued
 *
 * @package App\Models
 */
class FnExpense extends Model
{
	protected $table = 'fn_expenses';
	public $timestamps = false;

	protected $casts = [
		'date_created' => 'datetime'
	];

	protected $fillable = [
		'name',
		'description',
		'amount',
		'payment_mode',
		'type',
		'comment',
		'cash_comment',
		'paid_to',
		'created_by',
		'trancsation_date',
		'date_created',
		'receipt',
		'brc_id',
		'fund_source',
		'bank',
		'account',
		'time_select',
		'date_select',
		'receivables',
		'request_id',
		'receiptfrom',
		'receiptdate',
		'receiptfile',
		'receiptamount',
		'collectedby',
		'createdby',
		'datecreated',
		'chequeNo',
		'pay_no',
		'requestby',
		'requeston',
		'status',
		'authorizedby',
		'authorisedon',
		'voucher_id',
		'file',
		'appliedby',
		'approve_status',
		'appliedon',
		'approvedby',
		'approvedon',
		'issue_to',
		'date_issued'
	];
}
