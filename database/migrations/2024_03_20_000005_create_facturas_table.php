<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('facturas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->integer('mes');
            $table->integer('año');
            $table->decimal('antiguedad', 10, 2);
            $table->integer('presentismo');
            $table->integer('horas_extras_50');
            $table->integer('horas_extras_100');
            $table->integer('jubilacion');
            $table->integer('ley_19032');
            $table->integer('obra_social');
            $table->integer('sec_art_100');
            $table->integer('faecys_art_100');
            $table->integer('sec_art_101');
            $table->integer('osecac');
            $table->timestamps();

            // Índice único para evitar duplicados
            $table->unique(['user_id', 'mes', 'año']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('facturas');
    }
}; 