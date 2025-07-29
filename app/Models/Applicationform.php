<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Applicationform
 * 
 * @property int $id
 * @property string $formName
 * @property string|null $formType
 * @property string $currency
 * @property float $amount
 * @property string $status
 * @property Carbon|null $createdOn
 * @property int $createdBy
 * @property Carbon|null $updatedOn
 * @property int|null $updatedBy
 *
 * @package App\Models
 */
class Applicationform extends Model
{
	protected $table = 'applicationform';
	public $timestamps = false;

	protected $casts = [
		'amount' => 'float',
		'createdOn' => 'datetime',
		'createdBy' => 'int',
		'updatedOn' => 'datetime',
		'updatedBy' => 'int'
	];

	protected $fillable = [
		'formName',
		'formType',
		'currency',
		'amount',
		'status',
		'createdOn',
		'createdBy',
		'updatedOn',
		'updatedBy'
	];

	public function getFormCounts(){

		return Formsale::where('formType',$this->id)->get()->count();
	}
}
