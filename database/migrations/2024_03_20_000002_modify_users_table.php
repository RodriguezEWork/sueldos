<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('apellido');
            $table->string('dni')->unique();
            $table->date('fecha_nacimiento');
            $table->string('direccion');
            $table->string('telefono');
            $table->date('fecha_ingreso');
            $table->foreignId('cargo_id')->constrained('cargos');
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['cargo_id']);
            $table->dropColumn([
                'apellido',
                'dni',
                'fecha_nacimiento',
                'direccion',
                'telefono',
                'fecha_ingreso',
                'cargo_id'
            ]);
        });
    }
}; 