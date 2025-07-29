<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class BankAccount
 * 
 * @property int $id
 * @property string $bank_id
 * @property string $branch
 * @property string $account
 * @property string $created_by
 * @property string $created_on
 * @property int|null $brc_id
 *
 * @package App\Models
 */
class BankAccount extends Model
{
	protected $table = 'bank_account';
	public $timestamps = false;

	protected $casts = [
		'brc_id' => 'int'
	];

	protected $fillable = [
		'bank_id',
		'branch',
		'account',
		'created_by',
		'created_on',
		'brc_id'
	];
}
