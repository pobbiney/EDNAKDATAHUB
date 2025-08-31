<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DocumentCategory extends Model
{
    protected $table = 'document_categories';
    protected $fillable = ['name', 'status','created_by'];
}
