<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class AppBill
 * 
 * @property int $id
 * @property string|null $formId
 * @property string|null $bill_type
 * @property string|null $bill_amount
 * @property string|null $createdby
 * @property string|null $createdon
 * @property string|null $status
 *
 * @package App\Models
 */
class AppBill extends Model
{
	protected $table = 'app_bill';
	public $timestamps = false;

	protected $fillable = [
		'formId',
		'bill_type',
		'bill_amount',
		'createdby',
		'createdon',
		'status'
	];

	public function getBillType(){

		if(BillType::where('id',$this->bill_type)->get()->count() > 0){

			return BillType::find($this->bill_type)->name;

		}else{

			return 'Not Avaliable';

		}

		
	}

		public function getBillDescription (){

		 if(BillType::where('id',$this->bill_type)->get()->count() > 0){

			return BillType::find($this->bill_type)->description;

		 }else{

			return "N/A";
		 }

		 
	}
}
