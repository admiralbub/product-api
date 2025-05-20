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
        Schema::create('found_cheapers', function (Blueprint $table) {
            $table->id();
            $table->string("name");
            $table->string("phone");
            $table->unsignedBigInteger('product_id');
            $table->string("url");
            $table->string("comment")->nullable();
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('found_cheapers');
    }
};
