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
        Schema::create('neighbour_concerns', function (Blueprint $table) {
            $table->id();
             $table->unsignedBigInteger('app_id');
             $table->string('full_name');
             $table->string('telephone');
             $table->string('location');
              $table->string('concern');
            $table->string('status')->default('active');
            $table->unsignedBigInteger('created_by')->nullable();
            $table->timestamps();

             $table->foreign('app_id')->references('id')->on('permit_registrations')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('neighbour_concerns');
    }
};
      