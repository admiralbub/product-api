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
        Schema::create('blog_comments', function (Blueprint $table) {
            $table->id();
            $table->string('user_name');
            $table->text('comment');
            $table->string('email');
            $table->string('phone');
            $table->unsignedBigInteger('post_id');
            $table->boolean('available')->default(0)->nullable();
            $table->foreign('post_id')
                ->references('id')
                ->on('posts')
                ->onDelete('cascade');


            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('blog_comments');
    }
};
