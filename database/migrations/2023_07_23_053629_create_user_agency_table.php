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
        Schema::create('user_agency', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('agency_id')->nullable(); // Asegúrate de agregar ->nullable()
            $table->unsignedBigInteger('coordinator_id');
            $table->timestamps();

            $table->foreign('agency_id')->references('id')->on('users')->onDelete('set null');
            $table->foreign('coordinator_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_agency');
    }
};
