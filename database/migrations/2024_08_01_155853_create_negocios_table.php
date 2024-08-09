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
        Schema::create('negocios', function (Blueprint $table) {
            $table->id();
            $table->string('nombrenegocio');
            $table->string('ruc');
            $table->string('direccion');
            $table->string('metroscuadrados');
            $table->string('monto');
            $table->string('nLicencia');
            $table->string('nExpediente');
            $table->date('fecha');
            $table->foreignId('subcategoria_id')->nullable()->constrained('sub_categorias');
            $table->foreignId('administrado_id')->nullable()->constrained('administrados');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('negocios');
    }
};
