<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('permit_approvals', function (Blueprint $table) {
            $table->id();
            $table->string('formId');
            $table->string('application_type');
            $table->longText('evaluation');
            $table->string('decision_id');
            $table->longText('recommendation');
            $table->string('region_id');
            $table->string('created_by');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('permit_approvals');
    }
};
