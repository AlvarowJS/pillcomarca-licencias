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
        Schema::create('administrados', function (Blueprint $table) {
            $table->id();
            $table->string('nombreadministrado');
            $table->string('apellidoadministrado');
            $table->string('numero');
            $table->string('dni');
            $table->string('ruc');
            $table->string('gmail');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('administrados');
    }
};
