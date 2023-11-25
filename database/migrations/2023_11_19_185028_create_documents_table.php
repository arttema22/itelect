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
        Schema::create('documents', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')
                ->references('id')
                ->on('moonshine_users')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->unsignedBigInteger('doc_type_id')->nullable()->comment('Тип документа');
            $table->foreign('doc_type_id')
                ->references('id')
                ->on('doc_types')
                ->onUpdate('cascade')
                ->onDelete('set null');

            $table->unsignedBigInteger('org_id');
            $table->foreign('org_id')
                ->references('id')
                ->on('companies')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->unsignedBigInteger('company_id');
            $table->foreign('company_id')
                ->references('id')
                ->on('companies')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->date('date')->comment('Дата');
            $table->char('number')->comment('Номер');
            $table->date('validity_period')->nullable()->comment('Дата окончания');
            $table->char('path')->nullable()->comment('Путь');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('documents');
    }
};
