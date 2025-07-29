<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class PremiseFee
 * 
 * @property int $id
 * @property string|null $class_id
 * @property string|null $type_id
 * @property string|null $amount
 * @property string|null $currency
 * @property string|null $billType
 * @property string|null $description
 * @property string|null $status
 * @property Carbon|null $created_on
 *
 * @package App\Models
 */
class PremiseFee extends Model
{
	protected $table = 'premise_fees';
	public $timestamps = false;

	protected $casts = [
		'created_on' => 'datetime'
	];

	protected $fillable = [
		'class_id',
		'type_id',
		'amount',
		'currency',
		'billType',
		'description',
		'status',
		'created_on'
	];
}
