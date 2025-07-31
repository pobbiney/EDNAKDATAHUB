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
        Schema::table('bill_item', function (Blueprint $table) {
            $table->integer('sector');
            $table->integer('category');
            $table->integer('type');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('bill_item', function (Blueprint $table) {
            $table->dropColumn('sector');
             $table->dropColumn('category');
              $table->dropColumn('type');
        });
    }
};
