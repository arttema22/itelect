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
            $table->string('name');
            $table->string('address');
            $table->integer('inn')->unique();
            $table->string('kpp')->nullable();
            $table->string('director');
            $table->string('accountant')->nullable();
            $table->integer('bank_rs')->unique();
            $table->integer('bank_bik')->unique();
            $table->integer('bank_ks')->unique();
            $table->string('bank_name');
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
