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
        Schema::create('medicines_patients', function (Blueprint $table) {
            $table->id();
            $table->foreign('patient_id')->references('id')->on('patients');
            $table->unsignedBigInteger('patient_id')->nullable();
            $table->foreign('medicine_id')->references('id')->on('medicines');
            $table->unsignedBigInteger('medicine_id')->nullable();
            $table->bigInteger('no_cajas');
            $table->integer('dosis')->nullable();
            $table->integer('periodicidad')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('medicines_patients');
    }
};
