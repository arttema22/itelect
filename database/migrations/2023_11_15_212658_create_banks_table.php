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
        Schema::create('banks', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('company_id');
            $table->foreign('company_id')
                ->references('id')
                ->on('companies')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->char('name')->comment('Название');
            $table->decimal('bic', $precision = 9, $scale = 0)->nullable()->comment('БИК');
            $table->decimal('rs', $precision = 20, $scale = 0)->nullable()->comment('Расчетный счет');
            $table->decimal('ks', $precision = 20, $scale = 0)->nullable()->comment('Номер к/с');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('banks');
    }
};
