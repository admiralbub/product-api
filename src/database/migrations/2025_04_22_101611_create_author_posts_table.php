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
        Schema::create('author_posts', function (Blueprint $table) {
            $table->id();
            $table->string("name_ru");
            $table->string("name_ua");
            $table->string("img")->nullable();
            $table->text('description_ua')->nullable();
            $table->text('description_ru')->nullable();
            $table->boolean('available')->default(0)->nullable();

            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('author_posts');
    }
};
