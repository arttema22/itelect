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
        Schema::create('doc_templates', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')
                ->references('id')
                ->on('moonshine_users')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->unsignedBigInteger('doctype_id')->nullable()->comment('Тип документа');
            $table->foreign('doctype_id')
                ->references('id')
                ->on('doc_types')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->char('name')->comment('Название');
            $table->char('path')->comment('Путь');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('doc_templates');
    }
};
