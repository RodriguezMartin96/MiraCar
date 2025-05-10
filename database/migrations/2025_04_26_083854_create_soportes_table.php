<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('soportes', function (Blueprint $table) {
            $table->id();
            $table->string('email');
            $table->string('asunto');
            $table->text('descripcion');
            $table->enum('estado', ['Pendiente', 'En proceso', 'Resuelto', 'Cerrado'])->default('Pendiente');
            $table->text('respuesta')->nullable();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('set null');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('soportes');
    }
};