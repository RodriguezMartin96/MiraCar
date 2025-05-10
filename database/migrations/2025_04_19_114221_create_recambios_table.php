<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('recambios', function (Blueprint $table) {
            $table->id();
            $table->string('producto');
            $table->integer('cantidad');
            $table->string('referencia')->nullable();
            $table->decimal('precio', 8, 2)->nullable();
            $table->text('descripcion')->nullable();
            $table->foreignId('siniestro_id')->nullable()->constrained()->onDelete('cascade');
            $table->foreignId('user_id')->nullable()->constrained()->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('recambios');
    }
};