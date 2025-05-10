<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('vehiculos', function (Blueprint $table) {
            $table->id();
            $table->string('marca');
            $table->string('modelo');
            $table->string('matricula')->unique();
            $table->string('bastidor')->nullable();
            $table->date('fecha_matriculacion')->nullable();
            $table->string('color')->nullable();
            $table->foreignId('cliente_id')->constrained()->onDelete('cascade');
            $table->foreignId('user_id')->nullable()->constrained()->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('vehiculos');
    }
};