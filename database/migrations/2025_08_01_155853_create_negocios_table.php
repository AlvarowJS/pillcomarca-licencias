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
            $table->string('lugar');
            $table->string('manzana');
            $table->string('lote');
            $table->string('razonsocial');
            $table->text('imagen')->nullable();
            $table->text('redsocial')->nullable();
            $table->boolean('publico')->nullable();
            $table->foreignId('subcategoria_id')->nullable()->constrained('sub_categorias');
            $table->foreignId('administrado_id')->nullable()->constrained('administrados');
            $table->foreignId('actividad_economica_id')->nullable()->constrained('actividad_economicas');
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
