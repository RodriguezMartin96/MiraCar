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
        Schema::table('users', function (Blueprint $table) {
            $table->string('taller_name')->nullable();
            $table->string('taller_direccion')->nullable();
            $table->string('taller_telefono')->nullable();
            $table->text('taller_descripcion')->nullable();
            $table->text('taller_horario')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn([
                'taller_name',
                'taller_direccion',
                'taller_telefono',
                'taller_descripcion',
                'taller_horario'
            ]);
        });
    }
};