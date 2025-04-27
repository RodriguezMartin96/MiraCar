<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Paso 1: Asegurar que existe la columna user_id
        if (!Schema::hasColumn('clientes', 'user_id')) {
            Schema::table('clientes', function (Blueprint $table) {
                $table->unsignedBigInteger('user_id')->nullable()->after('email');
                $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            });
            Log::info('Columna user_id añadida a la tabla clientes');
        }
        
        // Paso 2: Eliminar el índice único existente en el campo email si existe
        try {
            Schema::table('clientes', function (Blueprint $table) {
                $table->dropUnique('clientes_email_unique');
            });
            Log::info('Índice clientes_email_unique eliminado correctamente');
        } catch (\Exception $e) {
            // El índice no existe, continuamos
            Log::info('No se encontró el índice clientes_email_unique para eliminar');
        }
        
        // Paso 3: Crear un nuevo índice único que combine email y user_id
        try {
            Schema::table('clientes', function (Blueprint $table) {
                $table->unique(['email', 'user_id'], 'clientes_email_user_id_unique');
            });
            Log::info('Índice clientes_email_user_id_unique creado correctamente');
        } catch (\Exception $e) {
            // El índice ya existe o hay otro problema
            Log::error('Error al crear índice email_user_id: ' . $e->getMessage());
        }
        
        // Paso 4: Crear un índice único para dni y user_id
        try {
            // Primero verificamos si la columna dni existe
            if (Schema::hasColumn('clientes', 'dni')) {
                // Intentamos eliminar cualquier índice existente en dni
                try {
                    DB::statement('ALTER TABLE clientes DROP INDEX IF EXISTS clientes_dni_unique');
                    Log::info('Índice clientes_dni_unique eliminado correctamente');
                } catch (\Exception $e) {
                    // Ignoramos errores si el índice no existe
                    Log::info('No se encontró el índice clientes_dni_unique para eliminar');
                }
                
                // Intentamos eliminar cualquier índice compuesto existente
                try {
                    DB::statement('ALTER TABLE clientes DROP INDEX IF EXISTS clientes_dni_user_id_unique');
                    Log::info('Índice clientes_dni_user_id_unique eliminado correctamente');
                } catch (\Exception $e) {
                    // Ignoramos errores si el índice no existe
                    Log::info('No se encontró el índice clientes_dni_user_id_unique para eliminar');
                }
                
                // Creamos el índice compuesto
                DB::statement('CREATE UNIQUE INDEX clientes_dni_user_id_unique ON clientes(dni, user_id)');
                Log::info('Índice clientes_dni_user_id_unique creado correctamente');
            }
        } catch (\Exception $e) {
            // Capturamos cualquier error y lo registramos
            Log::error('Error al crear índice dni_user_id: ' . $e->getMessage());
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Eliminar los índices compuestos
        try {
            Schema::table('clientes', function (Blueprint $table) {
                $table->dropUnique('clientes_email_user_id_unique');
            });
            Log::info('Índice clientes_email_user_id_unique eliminado correctamente');
        } catch (\Exception $e) {
            // El índice no existe, continuamos
            Log::info('No se encontró el índice clientes_email_user_id_unique para eliminar');
        }
        
        try {
            DB::statement('ALTER TABLE clientes DROP INDEX IF EXISTS clientes_dni_user_id_unique');
            Log::info('Índice clientes_dni_user_id_unique eliminado correctamente');
        } catch (\Exception $e) {
            // El índice no existe, continuamos
            Log::info('No se encontró el índice clientes_dni_user_id_unique para eliminar');
        }
        
        // Restaurar el índice único original para email
        try {
            Schema::table('clientes', function (Blueprint $table) {
                $table->unique('email');
            });
            Log::info('Índice clientes_email_unique restaurado correctamente');
        } catch (\Exception $e) {
            // El índice ya existe, continuamos
            Log::error('Error al restaurar índice email: ' . $e->getMessage());
        }
    }
};