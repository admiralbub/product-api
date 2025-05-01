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
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->string('name_ua');
            $table->string('name_ru');
            $table->text('description_ua')->nullable();
            $table->text('description_ru')->nullable();
            $table->string('slug');
            $table->string('img');
            $table->string('h1_ua');
            $table->string('h1_ru');
            $table->string('meta_title_ua');
            $table->string('meta_title_ru');
            $table->text('meta_description_ua');
            $table->text('meta_description_ru');
            $table->string('meta_keywords_ua')->nullable();
            $table->string('meta_keywords_ru')->nullable();
            $table->boolean('available')->default(0)->nullable();


            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('posts');
    }
};
