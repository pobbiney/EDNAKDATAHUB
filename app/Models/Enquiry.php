<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Enquiry extends Model
{
    protected $fillable = ['appId', 'typeId', 'serviceId','subject','description','status', 'createdBy', 'response', 'responseBy'];

    public function type()
    {
        return $this->belongsTo(EnquiryTypes::class, 'typeId');
    }

    public function service()
    {
        return $this->belongsTo(EnquiryServices::class, 'serviceId');
    }
}
