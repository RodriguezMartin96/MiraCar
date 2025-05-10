<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('siniestros', function (Blueprint $table) {
            try {
                $table->dropUnique('siniestros_numero_unique');
            } catch (\Exception $e) {
            }
        });
        
        Schema::table('siniestros', function (Blueprint $table) {
            $table->unique(['numero', 'user_id'], 'siniestros_numero_user_id_unique');
        });
    }

    public function down(): void
    {
        Schema::table('siniestros', function (Blueprint $table) {
            try {
                $table->dropUnique('siniestros_numero_user_id_unique');
            } catch (\Exception $e) {
            }
        });
        
        Schema::table('siniestros', function (Blueprint $table) {
            $table->unique('numero', 'siniestros_numero_unique');
        });
    }
};