<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('bonificaciones', function (Blueprint $table) {
            $table->id();
            $table->tinyInteger('tipo');
            $table->date('fecha');
            $table->time('start_time');
            $table->time('end_time');
            $table->date('fecha');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('bonificaciones');
    }
}; 