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
        Schema::table('permit_registrations', function (Blueprint $table) {
            $table->string('sector_id');
            $table->string('cat_id');
            $table->string('type_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('permit_registrations', function (Blueprint $table) {
            //
        });
    }
};
