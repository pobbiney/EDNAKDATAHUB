<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EnquiryTypes extends Model
{
    protected $table = 'enquiry_types';
    protected $fillable = ['name', 'status'];

    public function enquiries()
    {
        return $this->hasMany(Enquiry::class, 'typeId');
    }
}
