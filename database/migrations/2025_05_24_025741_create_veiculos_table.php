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
        Schema::create('veiculos', function (Blueprint $table) {
            $table->id();
            $table->string('modelo');
            $table->string('marca');
            $table->boolean('origem');
            $table->string('placa')->unique();
            $table->string('renavam')->unique();
            $table->string('chassi')->unique();
            $table->string('ano_fabricacao');
            $table->string('cor');
            $table->string('tipo_combustivel');
            $table->string('observacoes')->nullable();
            $table->integer('saldo')->default(1);
            $table->string('origin_user')->nullable();
            $table->string('last_user')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('veiculos');
    }
};
