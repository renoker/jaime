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
        Schema::create('medicine_stock_acopios', function (Blueprint $table) {
            $table->id();
            $table->foreign('acopio_id')->references('id')->on('acopios');
            $table->unsignedBigInteger('acopio_id')->nullable();
            $table->foreign('medicine_id')->references('id')->on('medicines');
            $table->unsignedBigInteger('medicine_id')->nullable();
            $table->foreign('patient_id')->references('id')->on('patients');
            $table->unsignedBigInteger('patient_id')->nullable();
            $table->bigInteger('stock');
            $table->dateTime('ingreso_almacen')->nullable();
            $table->dateTime('salida_almacen')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('medicine_stock_acopios');
    }
};
