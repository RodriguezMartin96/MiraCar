<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (Schema::hasTable('clientes') && !Schema::hasColumn('clientes', 'user_id')) {
            Schema::table('clientes', function (Blueprint $table) {
                $table->foreignId('user_id')->nullable()->constrained()->onDelete('cascade');
            });
        }

        if (Schema::hasTable('vehiculos') && !Schema::hasColumn('vehiculos', 'user_id')) {
            Schema::table('vehiculos', function (Blueprint $table) {
                $table->foreignId('user_id')->nullable()->constrained()->onDelete('cascade');
            });
        }

        if (Schema::hasTable('siniestros') && !Schema::hasColumn('siniestros', 'user_id')) {
            Schema::table('siniestros', function (Blueprint $table) {
                $table->foreignId('user_id')->nullable()->constrained()->onDelete('cascade');
            });
        }

        if (Schema::hasTable('recambios') && !Schema::hasColumn('recambios', 'user_id')) {
            Schema::table('recambios', function (Blueprint $table) {
                $table->foreignId('user_id')->nullable()->constrained()->onDelete('cascade');
            });
        }

        if (Schema::hasTable('documentos') && !Schema::hasColumn('documentos', 'user_id')) {
            Schema::table('documentos', function (Blueprint $table) {
                $table->foreignId('user_id')->nullable()->constrained()->onDelete('cascade');
            });
        }

        if (Schema::hasTable('soportes') && !Schema::hasColumn('soportes', 'user_id')) {
            Schema::table('soportes', function (Blueprint $table) {
                $table->foreignId('user_id')->nullable()->constrained()->onDelete('cascade');
            });
        }
    }

    public function down(): void
    {
        if (Schema::hasTable('clientes') && Schema::hasColumn('clientes', 'user_id')) {
            Schema::table('clientes', function (Blueprint $table) {
                $table->dropConstrainedForeignId('user_id');
            });
        }

        if (Schema::hasTable('vehiculos') && Schema::hasColumn('vehiculos', 'user_id')) {
            Schema::table('vehiculos', function (Blueprint $table) {
                $table->dropConstrainedForeignId('user_id');
            });
        }

        if (Schema::hasTable('siniestros') && Schema::hasColumn('siniestros', 'user_id')) {
            Schema::table('siniestros', function (Blueprint $table) {
                $table->dropConstrainedForeignId('user_id');
            });
        }

        if (Schema::hasTable('recambios') && Schema::hasColumn('recambios', 'user_id')) {
            Schema::table('recambios', function (Blueprint $table) {
                $table->dropConstrainedForeignId('user_id');
            });
        }

        if (Schema::hasTable('documentos') && Schema::hasColumn('documentos', 'user_id')) {
            Schema::table('documentos', function (Blueprint $table) {
                $table->dropConstrainedForeignId('user_id');
            });
        }

        if (Schema::hasTable('soportes') && Schema::hasColumn('soportes', 'user_id')) {
            Schema::table('soportes', function (Blueprint $table) {
                $table->dropConstrainedForeignId('user_id');
            });
        }
    }
};