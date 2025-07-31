<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use App\Models\CertificateApp;
use App\Models\Staff;
use App\Models\AppBill;
use App\Models\Payment;
use App\Models\PermitApp;

/**
 * Class Task
 * 
 * @property int $id
 * @property string|null $description
 * @property int $assignee
 * @property string|null $status
 * @property int $taskId
 * @property Carbon|null $createdOn
 * @property int|null $createdBy
 * @property int|null $updateBy
 * @property Carbon|null $updateOn
 * @property string $taskType
 *
 * @package App\Models
 */
class Task extends Model
{
	protected $table = 'task';
	public $timestamps = false;

	protected $casts = [
		'assignee' => 'int',
		'taskId' => 'int',
		'createdOn' => 'datetime',
		'createdBy' => 'int',
		'updateBy' => 'int',
		'updateOn' => 'datetime'
	];

	protected $fillable = [
		'description',
		'assignee',
		'status',
		'taskId',
		'createdOn',
		'createdBy',
		'updateBy',
		'updateOn',
		'taskType'
	];
	function taskname(){
        return $this->belongsTo(Staff::class, 'assignee','staff_id');
    }
	public function certificateApp() {
		return $this->belongsTo(PermitRegistration::class, 'taskId', 'id'); // If taskId is your FK
		// or more conventionally:
		// return $this->belongsTo(CertificateApp::class, 'certificate_app_id');
	}

	public function permitApp() {
		return $this->belongsTo(PermitRegistration::class, 'taskId', 'id'); // If taskId is your FK
		// or more conventionally:
		// return $this->belongsTo(PemitAPp::class, 'certificate_app_id');
	}

	public function assignees()
    {
        return $this->belongsTo(Staff::class, 'assignee', 'staff_id');
    }

    public function bills()
    {
        return $this->hasMany(AppBill::class, 'formId', 'TaskId');
    }

    public function payments()
    {
        return $this->hasMany(Payment::class, 'formId', 'TaskId');
    }
	 
}
