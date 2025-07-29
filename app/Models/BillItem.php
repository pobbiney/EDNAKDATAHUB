<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class BillItem
 * 
 * @property int $id
 * @property string $name
 * @property string $currency
 * @property string|null $description
 * @property string $status
 * @property int $createdBy
 * @property Carbon|null $createdOn
 * @property int|null $updatedBy
 * @property Carbon|null $updatedOn
 * @property float|null $amount
 * @property int|null $billType
 * @property int|null $floorValue
 * @property string|null $premiseuse
 *
 * @package App\Models
 */
class BillItem extends Model
{
	protected $table = 'bill_item';
	public $timestamps = false;

	protected $casts = [
		'createdBy' => 'int',
		'createdOn' => 'datetime',
		'updatedBy' => 'int',
		'updatedOn' => 'datetime',
		'amount' => 'float',
		'billType' => 'int',
		'floorValue' => 'int'
	];

	protected $fillable = [
		'name',
		'currency',
		'description',
		'status',
		'createdBy',
		'createdOn',
		'updatedBy',
		'updatedOn',
		'amount',
		'billType',
		'floorValue',
		'premiseuse'
	];

	public function getBillType (){

		 if(BillType::where('id',$this->billType)->get()->count() > 0){

			return BillType::find($this->billType)->name;

		 }else{

			return "N/A";
		 }

		 
	}
	 
}
