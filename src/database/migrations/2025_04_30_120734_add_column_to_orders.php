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
        Schema::table('orders', function (Blueprint $table) {
            
            if (Schema::hasColumn('orders', 'is_pay')) {
                $table->boolean('is_pay')->default(false)->nullable()->change();
            } else {
                $table->boolean('is_pay')->default(false)->nullable();
            }

            if (Schema::hasColumn('orders', 'pay_amount')) {
                $table->decimal('pay_amount', 10, 2)->nullable()->change();
            } else {
                $table->decimal('pay_amount', 10, 2)->nullable();
            }

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            //
        });
    }
};
