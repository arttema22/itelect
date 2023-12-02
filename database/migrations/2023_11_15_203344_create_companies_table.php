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
        Schema::create('companies', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')
                ->references('id')
                ->on('moonshine_users')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->unsignedBigInteger('opf_id')->nullable()->comment('ОПФ');
            $table->foreign('opf_id')
                ->references('id')
                ->on('opfs')
                ->onUpdate('cascade')
                ->onDelete('set null');

            $table->char('name_full')->comment('Название полное');
            $table->char('name_short')->comment('Название короткое');
            $table->decimal('inn', $precision = 12, $scale = 0)->nullable()->comment('ИНН');
            $table->decimal('ogrn', $precision = 13, $scale = 0)->nullable()->comment('ОГРН');
            $table->decimal('ogrnip', $precision = 15, $scale = 0)->nullable()->comment('ОГРНИП');
            $table->decimal('okpo', $precision = 8, $scale = 0)->nullable()->comment('ОКПО');
            $table->decimal('okato', $precision = 11, $scale = 0)->nullable()->comment('ОКАТО');
            $table->decimal('oktmo', $precision = 11, $scale = 0)->nullable()->comment('ОКТМО');
            $table->decimal('okogu', $precision = 7, $scale = 0)->nullable()->comment('ОКОГУ');
            $table->decimal('okfs', $precision = 2, $scale = 0)->nullable()->comment('ОКФС');
            $table->decimal('kpp', $precision = 9, $scale = 0)->nullable()->comment('КПП');
            $table->char('okved')->nullable()->comment('ОКВЭД');
            $table->char('email')->nullable()->comment('почта');
            $table->decimal('phone', $precision = 11, $scale = 0)->nullable()->comment('телефон');
            $table->text('description')->nullable()->comment('Комментарий');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('companies');
    }
};
