<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddUserIdToBonificacionesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('bonificaciones', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id')->nullable()->after('id'); // Agrega la columna después de 'id'
            
            // Si existe una relación con la tabla 'users', puedes añadir la clave foránea
            // $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('bonificaciones', function (Blueprint $table) {
            // Si añadiste la clave foránea, elimina la relación primero
            // $table->dropForeign(['user_id']);
            
            $table->dropColumn('user_id');
        });
    }
}
