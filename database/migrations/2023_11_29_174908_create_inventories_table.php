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
        Schema::create('inventories', function (Blueprint $table) {
            $table->id();
            $table->foreign('acopio_id')->references('id')->on('acopios');
            $table->unsignedBigInteger('acopio_id')->nullable();
            $table->string('image')->nullable();
            $table->string('clave')->nullable();
            $table->longText('descripcion')->nullable();
            $table->string('principal_activo')->nullable();
            $table->string('laboratorio')->nullable();
            $table->decimal('iva', $precision = 8, $scale = 2)->nullable();
            $table->double('pecio_maximo', 8, 2)->nullable();
            $table->integer('descuento')->nullable();
            $table->double('pecio', 8, 2)->nullable();
            $table->double('pecio_anterior', 8, 2)->nullable();
            $table->bigInteger('stock')->nullable();
            $table->bigInteger('contenido')->nullable();
            $table->text('comentarios')->nullable();
            $table->date('caducidad')->nullable();
            $table->string('codigo_barras')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inventories');
    }
};
