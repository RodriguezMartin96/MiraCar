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
        // Añadir user_id a la tabla clientes
        if (Schema::hasTable('clientes') && !Schema::hasColumn('clientes', 'user_id')) {
            Schema::table('clientes', function (Blueprint $table) {
                $table->foreignId('user_id')->nullable()->constrained()->onDelete('cascade');
            });
        }

        // Añadir user_id a la tabla vehiculos
        if (Schema::hasTable('vehiculos') && !Schema::hasColumn('vehiculos', 'user_id')) {
            Schema::table('vehiculos', function (Blueprint $table) {
                $table->foreignId('user_id')->nullable()->constrained()->onDelete('cascade');
            });
        }

        // Añadir user_id a la tabla siniestros
        if (Schema::hasTable('siniestros') && !Schema::hasColumn('siniestros', 'user_id')) {
            Schema::table('siniestros', function (Blueprint $table) {
                $table->foreignId('user_id')->nullable()->constrained()->onDelete('cascade');
            });
        }

        // Añadir user_id a la tabla recambios
        if (Schema::hasTable('recambios') && !Schema::hasColumn('recambios', 'user_id')) {
            Schema::table('recambios', function (Blueprint $table) {
                $table->foreignId('user_id')->nullable()->constrained()->onDelete('cascade');
            });
        }

        // Añadir user_id a la tabla documentos
        if (Schema::hasTable('documentos') && !Schema::hasColumn('documentos', 'user_id')) {
            Schema::table('documentos', function (Blueprint $table) {
                $table->foreignId('user_id')->nullable()->constrained()->onDelete('cascade');
            });
        }

        // Añadir user_id a la tabla soportes
        if (Schema::hasTable('soportes') && !Schema::hasColumn('soportes', 'user_id')) {
            Schema::table('soportes', function (Blueprint $table) {
                $table->foreignId('user_id')->nullable()->constrained()->onDelete('cascade');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Eliminar user_id de la tabla clientes
        if (Schema::hasTable('clientes') && Schema::hasColumn('clientes', 'user_id')) {
            Schema::table('clientes', function (Blueprint $table) {
                $table->dropConstrainedForeignId('user_id');
            });
        }

        // Eliminar user_id de la tabla vehiculos
        if (Schema::hasTable('vehiculos') && Schema::hasColumn('vehiculos', 'user_id')) {
            Schema::table('vehiculos', function (Blueprint $table) {
                $table->dropConstrainedForeignId('user_id');
            });
        }

        // Eliminar user_id de la tabla siniestros
        if (Schema::hasTable('siniestros') && Schema::hasColumn('siniestros', 'user_id')) {
            Schema::table('siniestros', function (Blueprint $table) {
                $table->dropConstrainedForeignId('user_id');
            });
        }

        // Eliminar user_id de la tabla recambios
        if (Schema::hasTable('recambios') && Schema::hasColumn('recambios', 'user_id')) {
            Schema::table('recambios', function (Blueprint $table) {
                $table->dropConstrainedForeignId('user_id');
            });
        }

        // Eliminar user_id de la tabla documentos
        if (Schema::hasTable('documentos') && Schema::hasColumn('documentos', 'user_id')) {
            Schema::table('documentos', function (Blueprint $table) {
                $table->dropConstrainedForeignId('user_id');
            });
        }

        // Eliminar user_id de la tabla soportes
        if (Schema::hasTable('soportes') && Schema::hasColumn('soportes', 'user_id')) {
            Schema::table('soportes', function (Blueprint $table) {
                $table->dropConstrainedForeignId('user_id');
            });
        }
    }
};