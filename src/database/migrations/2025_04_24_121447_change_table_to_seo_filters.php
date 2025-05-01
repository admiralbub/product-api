<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('seo_filters', function (Blueprint $table) {
            // Если столбца нет — создаем, если есть — изменяем
            if (!Schema::hasColumn('seo_filters', 'name_filter')) {
                $table->string('name_filter')->nullable();
            } else {
                $table->string('name_filter')->change();
            }

            // Остальные изменения (тоже с проверкой)
            if (Schema::hasColumn('seo_filters', 'is_template')) {
                $table->boolean('is_template')->default(false)->change();
            } else {
                $table->boolean('is_template')->default(false)->nullable();
            }

            if (Schema::hasColumn('seo_filters', 'url')) {
                $table->string('url')->nullable()->change();
            } else {
                $table->string('url')->nullable();
            }

            if (Schema::hasColumn('seo_filters', 'type_filter')) {
                $table->integer('type_filter')->nullable()->change();
            } else {
                $table->integer('type_filter')->nullable()->nullable();
            }

            // Удаляем category_id (если он есть)
            if (Schema::hasColumn('seo_filters', 'category_id')) {
                $table->dropForeign(['category_id']);
                $table->dropColumn('category_id');
            }
        });
    }

    public function down(): void
    {
        Schema::table('seo_filters', function (Blueprint $table) {
            // Возвращаем category_id (если нужно откатить)
            $table->unsignedBigInteger('category_id')->nullable();
            $table->foreign('category_id')->references('id')->on('categories');

            // Можно добавить откат других изменений, если требуется
        });
    }
};