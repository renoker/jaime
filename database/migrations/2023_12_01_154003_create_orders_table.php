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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreign('acopio_id')->references('id')->on('acopios');
            $table->unsignedBigInteger('acopio_id')->nullable();
            $table->foreign('status_orden_id')->references('id')->on('status_ordens');
            $table->unsignedBigInteger('status_orden_id')->default(1);
            $table->text('notas')->nullable();
            $table->date('fecha')->nullable();
            $table->string('image')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
