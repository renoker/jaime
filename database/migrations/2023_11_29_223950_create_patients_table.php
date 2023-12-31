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
        Schema::create('patients', function (Blueprint $table) {
            $table->id();
            $table->foreign('acopio_id')->references('id')->on('acopios');
            $table->unsignedBigInteger('acopio_id')->nullable();
            $table->string('image')->nullable();
            $table->string('name')->nullable();
            $table->string('edad')->nullable();
            $table->text('direccion')->nullable();
            $table->string('profecion')->nullable();
            $table->date('cumpleanios')->nullable();
            $table->string('email')->nullable();
            $table->string('telefono')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('patients');
    }
};
