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
        Schema::create('prestamos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('ficha_id')->constrained('fichas')->onDelete('cascade')->onUpdate('cascade');
            $table->string('ci_prestatario', 8);
            $table->string('nombre_prestatario', 255);
            $table->string('apellido_prestatario', 255);
            $table->string('tlf_prestatario');
            $table->date('fecha_prestamo');
            $table->date('fecha_devolucion');
            $table->date('fecha_entrega')->nullable();
            $table->enum('estado', ['prestado', 'devuelto'])->default('prestado');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('prestamos');
    }
};
