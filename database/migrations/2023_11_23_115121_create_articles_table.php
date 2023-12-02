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
        Schema::create('articles', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')
                ->references('id')
                ->on('moonshine_users')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->string('title')->comment('Заголовок');
            $table->string('slug')->nullable();
            $table->text('content')->comment('Содержание');
            $table->text('thumbnail')
                ->nullable()->comment('Изображение');
            $table->text('description')->nullable()->comment('SEO-описание');
            $table->text('keywords')->nullable()->comment('SEO-ключевые слова');
            $table->boolean('is_publish')->default('0')->comment('Статус');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('articles');
    }
};
