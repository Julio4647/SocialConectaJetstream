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
            $table->string('activity');
            $table->string('city');
            $table->string('state');
            $table->string('country');
            $table->string('representative_name');
            $table->string('email')->unique();
            $table->string('phone');
            $table->string('service');
            $table->bigInteger('communitys_id')->unsigned()->nullable()->default(null); // Columna para el ID de la comunidad
            $table->string('price');
            $table->date('start_date');
            $table->date('expiration_date');
            $table->date('pay_day');
            $table->timestamps();
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
