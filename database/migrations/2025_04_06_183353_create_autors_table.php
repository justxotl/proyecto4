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
        Schema::create('autors', function (Blueprint $table) {
            $table->id();
            $table->string('ci_autor', 8)->unique();
            $table->string('nombre_autor', 250);
            $table->string('apellido_autor', 250);
            $table->foreignId('ficha_id')->nullable()->constrained()->onDelete('cascade')->onUpdate('cascade'); // Relación con la tabla de autores
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('autors');
    }
};
