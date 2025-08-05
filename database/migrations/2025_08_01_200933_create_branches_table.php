<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('branches', function (Blueprint $table) {
            $table->integer('id');
            $table->string('branch_name',300)->nullable();
            $table->string('branch_code',300)->nullable();
            $table->integer('business_id')->nullable();
            $table->integer('town_id')->nullable();
            $table->integer('district_id')->nullable();
            $table->longText('address')->nullable();
            $table->string('phone')->nullable();
            $table->integer('region_id')->nullable();
            $table->string('status')->nullable();
            $table->integer('created_by')->nullable();
            $table->time('created_on')->default(Carbon::now());
            $table->integer('updated_by')->nullable();
            $table->string('updated_on')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('branches');
    }
};
