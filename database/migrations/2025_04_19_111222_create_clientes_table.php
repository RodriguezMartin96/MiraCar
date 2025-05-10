<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('clientes', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->string('apellidos');
            $table->string('dni')->nullable();
            $table->string('direccion')->nullable();
            $table->string('telefono');
            $table->string('email')->unique();
            $table->string('cif')->nullable();
            $table->string('direccion_juridica')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('clientes');
    }
};