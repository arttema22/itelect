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
        Schema::create('persons', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')
                ->references('id')
                ->on('moonshine_users')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->char('name')->comment('Имя');
            $table->char('surname')->nullable()->comment('Отчество');
            $table->char('secname')->nullable()->comment('Фамилия');
            $table->char('position')->nullable()->comment('Должность');
            $table->decimal('phone', $precision = 11, $scale = 0)->nullable()->comment('телефон');
            $table->char('email')->nullable()->comment('почта');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('persons');
    }
};
