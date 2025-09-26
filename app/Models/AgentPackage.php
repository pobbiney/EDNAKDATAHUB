<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AgentPackage extends Model
{
        public function provider()
{
	return $this->belongsTo(ServiceProvider::class, 'provider_id', 'id'); // Adjust if your FK is different
}
}
