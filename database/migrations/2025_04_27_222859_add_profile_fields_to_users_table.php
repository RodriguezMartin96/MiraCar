<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            if (!Schema::hasColumn('users', 'phone')) {
                $table->string('phone')->nullable();
            }
            if (!Schema::hasColumn('users', 'company_name')) {
                $table->string('company_name')->nullable();
            }
            if (!Schema::hasColumn('users', 'company_nif')) {
                $table->string('company_nif')->nullable();
            }
            if (!Schema::hasColumn('users', 'logo')) {
                $table->string('logo')->nullable();
            }
            if (!Schema::hasColumn('users', 'role')) {
                $table->string('role')->default('user');
            }
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['phone', 'company_name', 'company_nif', 'logo', 'role']);
        });
    }
};