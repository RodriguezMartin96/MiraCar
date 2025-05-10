<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasColumn('clientes', 'user_id')) {
            Schema::table('clientes', function (Blueprint $table) {
                $table->unsignedBigInteger('user_id')->nullable()->after('email');
                $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            });
            Log::info('Columna user_id añadida a la tabla clientes');
        }
        
        try {
            Schema::table('clientes', function (Blueprint $table) {
                $table->dropUnique('clientes_email_unique');
            });
            Log::info('Índice clientes_email_unique eliminado correctamente');
        } catch (\Exception $e) {
            Log::info('No se encontró el índice clientes_email_unique para eliminar');
        }
        
        try {
            Schema::table('clientes', function (Blueprint $table) {
                $table->unique(['email', 'user_id'], 'clientes_email_user_id_unique');
            });
            Log::info('Índice clientes_email_user_id_unique creado correctamente');
        } catch (\Exception $e) {
            Log::error('Error al crear índice email_user_id: ' . $e->getMessage());
        }
        
        try {
            if (Schema::hasColumn('clientes', 'dni')) {
                try {
                    DB::statement('ALTER TABLE clientes DROP INDEX IF EXISTS clientes_dni_unique');
                    Log::info('Índice clientes_dni_unique eliminado correctamente');
                } catch (\Exception $e) {
                    Log::info('No se encontró el índice clientes_dni_unique para eliminar');
                }
                
                try {
                    DB::statement('ALTER TABLE clientes DROP INDEX IF EXISTS clientes_dni_user_id_unique');
                    Log::info('Índice clientes_dni_user_id_unique eliminado correctamente');
                } catch (\Exception $e) {
                    Log::info('No se encontró el índice clientes_dni_user_id_unique para eliminar');
                }
                
                DB::statement('CREATE UNIQUE INDEX clientes_dni_user_id_unique ON clientes(dni, user_id)');
                Log::info('Índice clientes_dni_user_id_unique creado correctamente');
            }
        } catch (\Exception $e) {
            Log::error('Error al crear índice dni_user_id: ' . $e->getMessage());
        }
    }

    public function down(): void
    {
        try {
            Schema::table('clientes', function (Blueprint $table) {
                $table->dropUnique('clientes_email_user_id_unique');
            });
            Log::info('Índice clientes_email_user_id_unique eliminado correctamente');
        } catch (\Exception $e) {
            Log::info('No se encontró el índice clientes_email_user_id_unique para eliminar');
        }
        
        try {
            DB::statement('ALTER TABLE clientes DROP INDEX IF EXISTS clientes_dni_user_id_unique');
            Log::info('Índice clientes_dni_user_id_unique eliminado correctamente');
        } catch (\Exception $e) {
            Log::info('No se encontró el índice clientes_dni_user_id_unique para eliminar');
        }
        
        try {
            Schema::table('clientes', function (Blueprint $table) {
                $table->unique('email');
            });
            Log::info('Índice clientes_email_unique restaurado correctamente');
        } catch (\Exception $e) {
            Log::error('Error al restaurar índice email: ' . $e->getMessage());
        }
    }
};