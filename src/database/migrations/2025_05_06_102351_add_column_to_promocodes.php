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
        Schema::table('promocodes', function (Blueprint $table) {
           // $table->integer("min_total_activation")->nullable();
            $table->decimal('min_total_activation', 9, 3)->nullable();

            $table->date('start_promocode_date')->nullable();
            $table->date('end_promocode_date')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('promocodes', function (Blueprint $table) {
            //
        });
    }
};
