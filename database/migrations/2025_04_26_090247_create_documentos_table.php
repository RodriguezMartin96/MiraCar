<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('documentos', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->string('descripcion');
            $table->string('formato');
            $table->string('ruta_archivo');
            $table->string('otro_nombre')->nullable();
            $table->string('otra_descripcion')->nullable();
            $table->foreignId('user_id')->nullable()->constrained()->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('documentos');
    }
};