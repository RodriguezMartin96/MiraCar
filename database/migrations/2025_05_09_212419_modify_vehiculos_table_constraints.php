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
        try {
            Schema::table('vehiculos', function (Blueprint $table) {
                $table->dropUnique('vehiculos_matricula_unique');
            });
            Log::info('Índice vehiculos_matricula_unique eliminado correctamente');
        } catch (\Exception $e) {
            Log::info('No se encontró el índice vehiculos_matricula_unique para eliminar');
        }
        
        try {
            Schema::table('vehiculos', function (Blueprint $table) {
                $table->dropUnique('vehiculos_bastidor_unique');
            });
            Log::info('Índice vehiculos_bastidor_unique eliminado correctamente');
        } catch (\Exception $e) {
            Log::info('No se encontró el índice vehiculos_bastidor_unique para eliminar');
        }
        
        Schema::table('vehiculos', function (Blueprint $table) {
            $table->unique(['matricula', 'user_id'], 'vehiculos_matricula_user_id_unique');
            $table->unique(['bastidor', 'user_id'], 'vehiculos_bastidor_user_id_unique');
        });
    }

    public function down(): void
    {
        try {
            Schema::table('vehiculos', function (Blueprint $table) {
                $table->dropUnique('vehiculos_matricula_user_id_unique');
            });
            Log::info('Índice vehiculos_matricula_user_id_unique eliminado correctamente');
        } catch (\Exception $e) {
            Log::info('No se encontró el índice vehiculos_matricula_user_id_unique para eliminar');
        }
        
        try {
            Schema::table('vehiculos', function (Blueprint $table) {
                $table->dropUnique('vehiculos_bastidor_user_id_unique');
            });
            Log::info('Índice vehiculos_bastidor_user_id_unique eliminado correctamente');
        } catch (\Exception $e) {
            Log::info('No se encontró el índice vehiculos_bastidor_user_id_unique para eliminar');
        }
        
        $duplicados = DB::table('vehiculos')
            ->select('matricula')
            ->whereNotNull('matricula')
            ->groupBy('matricula')
            ->havingRaw('COUNT(*) > 1')
            ->get();
        
        if ($duplicados->count() > 0) {
            Log::warning('No se puede restaurar el índice único para matricula porque hay matrículas duplicadas', [
                'duplicados' => $duplicados->pluck('matricula')->toArray()
            ]);
        } else {
            try {
                Schema::table('vehiculos', function (Blueprint $table) {
                    $table->unique('matricula', 'vehiculos_matricula_unique');
                });
                Log::info('Índice vehiculos_matricula_unique restaurado correctamente');
            } catch (\Exception $e) {
                Log::error('Error al restaurar el índice vehiculos_matricula_unique: ' . $e->getMessage());
            }
        }
        
        $duplicadosBastidor = DB::table('vehiculos')
            ->select('bastidor')
            ->whereNotNull('bastidor')
            ->groupBy('bastidor')
            ->havingRaw('COUNT(*) > 1')
            ->get();
        
        if ($duplicadosBastidor->count() > 0) {
            Log::warning('No se puede restaurar el índice único para bastidor porque hay bastidores duplicados', [
                'duplicados' => $duplicadosBastidor->pluck('bastidor')->toArray()
            ]);
        } else {
            try {
                Schema::table('vehiculos', function (Blueprint $table) {
                    $table->unique('bastidor', 'vehiculos_bastidor_unique');
                });
                Log::info('Índice vehiculos_bastidor_unique restaurado correctamente');
            } catch (\Exception $e) {
                Log::error('Error al restaurar el índice vehiculos_bastidor_unique: ' . $e->getMessage());
            }
        }
    }
};