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
        Schema::create('orden_medinas', function (Blueprint $table) {
            $table->id();
            $table->foreign('order_id')->references('id')->on('orders');
            $table->unsignedBigInteger('order_id')->nullable();
            $table->foreign('patient_id')->references('id')->on('patients');
            $table->unsignedBigInteger('patient_id')->nullable();
            $table->foreign('medicine_id')->references('id')->on('medicines');
            $table->unsignedBigInteger('medicine_id')->nullable();
            $table->integer('cantidad')->nullable();
            $table->double('pecio', 8, 2)->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orden_medinas');
    }
};
