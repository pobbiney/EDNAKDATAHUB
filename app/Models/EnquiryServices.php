<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EnquiryServices extends Model
{
    protected $table = 'enquiry_services';
    protected $fillable = ['name', 'status'];

    public function enquiries()
    {
        return $this->hasMany(Enquiry::class, 'serviceId');
    }
}
