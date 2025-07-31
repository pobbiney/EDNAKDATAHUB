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
        Schema::create('permit_registrations', function (Blueprint $table) {
            $table->id();
            $table->string('proponent_name');
            $table->string('contact_person');
            $table->string('city');
            $table->longText('address');
            $table->string('position');
            $table->string('contact_number');
            $table->string('email');
            $table->string('registration_step')->nullable();
            $table->string('formID');
             $table->string('project_title')->nullable();
            $table->string('plot_number')->nullable();
            $table->string('street_name')->nullable();
            $table->longText('project_description')->nullable();
            $table->longText('scope')->nullable();
            $table->string('gps')->nullable();
            $table->string('town')->nullable();
            $table->string('region')->nullable();
            $table->string('district')->nullable();
            $table->string('landmark')->nullable();
            $table->string('land_uses')->nullable();
            $table->longText('site_description')->nullable();
            $table->longText('structures')->nullable();
            $table->longText('water')->nullable();
            $table->longText('power')->nullable();
            $table->longText('drainage')->nullable();
            $table->longText('water_body')->nullable();
            $table->longText('road_access')->nullable();
            $table->longText('other')->nullable();
            $table->string('applied_by')->nullable();
            $table->string('declaration')->nullable();
            $table->string('created_by')->nullable();
            $table->string('status')->default('Pending');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('permit_registrations');
    }
};
