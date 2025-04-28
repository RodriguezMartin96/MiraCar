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
        Schema::table('siniestros', function (Blueprint $table) {
            // Asegurarse de que el campo numero existe y es único
            if (!Schema::hasColumn('siniestros', 'numero')) {
                $table->string('numero')->unique()->after('id');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('siniestros', function (Blueprint $table) {
            // No eliminamos el campo numero en caso de rollback
            // ya que podría contener datos importantes
        });
    }
};