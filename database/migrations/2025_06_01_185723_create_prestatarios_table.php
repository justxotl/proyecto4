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
        Schema::create('prestatarios', function (Blueprint $table) {
            $table->id();
            $table->string('ci_prestatario', 8);
            $table->string('nombre_prestatario', 255);
            $table->string('apellido_prestatario', 255);
            $table->string('tlf_prestatario', 11);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('prestatarios');
    }
};
