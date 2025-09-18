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
        Schema::create('institutions', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('short_name')->nullable();
            $table->string('location');
            $table->string('email');
            $table->string('telephone');
            $table->integer('category_id');
            $table->integer('type_id');
            $table->longText('about');
            $table->string('contact_person_firstname')->nullable();
            $table->string('contact_person_lastname')->nullable();
            $table->string('contact_person_email')->nullable();
            $table->string('contact_person_designation')->nullable();
            $table->string('contact_person_telephone')->nullable();
            $table->string('logo')->nullable();
            $table->integer('created_by')->nullable();
            $table->integer('updated_by')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('institutions');
    }
};
