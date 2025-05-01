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
        Schema::create('seo_filters', function (Blueprint $table) {
            $table->id();



            $table->string('h1_ua');
            $table->string('h1_ru');
            $table->string('meta_title_ua');
            $table->string('meta_title_ru');
            $table->text('meta_description_ua');
            $table->text('meta_description_ru');
            $table->string('meta_keywords_ua')->nullable();
            $table->string('meta_keywords_ru')->nullable();

            $table->text('description_ua')->nullable();
            $table->text('description_ru')->nullable();
            $table->unsignedBigInteger('category_id');
            $table->foreign('category_id')
                ->references('id')
                ->on('categories')
                ->onDelete('cascade');

            $table->integer('type_filter');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('seo_filters');
    }
};
