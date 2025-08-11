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
        Schema::create('enquiries', function (Blueprint $table) {
            $table->id();
             $table->integer('appId');
            $table->unsignedBigInteger('typeId');
            $table->unsignedBigInteger('serviceId');
            $table->string('subject');
            $table->longText('description');
             $table->string(column: 'status')->nullable();
             $table->integer('createdBy')->nullable(); 
             $table->longText('response')->nullable();
             $table->integer('responseBy')->nullable();
            $table->foreign('typeId')->references('id')->on('enquiry_types')->onDelete('cascade');
            $table->foreign('serviceId')->references('id')->on('enquiry_services')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('enquiries');
    }
};
