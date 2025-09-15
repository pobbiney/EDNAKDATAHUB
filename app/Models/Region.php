<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Region extends Model
{
     public $timestamps = false;
    
    protected $fillable = ['name', 'description', 'code', 'status']; 


    public function getCertificateCount(){

        return CertificateApp::where('region',''.$this->id)->get()->count();
    }

     public function getApprovedCertificateCount(){

        return CertificateApp::where([['region',''.$this->id],['status','Approved']])->get()->count();
    }


     public function getPermitCount(){

        return PermitApp::where('region',''.$this->id)->get()->count();
    }

     public function getApprovedPermitCount(){

        return PermitApp::where([['region',''.$this->id],['status','vettingApproved']])->get()->count();
    }
    	public function reg()
{
    return $this->hasMany(Incident::class, 'region_id');
}
}
