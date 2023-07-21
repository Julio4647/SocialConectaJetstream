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
        Schema::create('clients', function (Blueprint $table) {
            $table->engine="InnoDB";
            $table->id();
            $table->string('name');
            $table->string('last_name');
            $table->string('phone');
            $table->string('email')->unique();
            $table->date('start_date');
            $table->date('expiration_date');
            $table->date('pay_day');
            $table->bigInteger('communitys_id')->unsigned(); // Columna para el ID de la comunidad
            $table->timestamps();
            // Definir la clave foránea para enlazar con la tabla users (community)
        $table->foreign('communitys_id')
        ->references('id')
        ->on('users')
        ->onDelete('set null'); // Cambiar onDelete a 'set null'

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('clients');
    }
};
