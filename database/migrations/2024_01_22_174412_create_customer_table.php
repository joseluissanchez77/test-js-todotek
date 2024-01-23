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
        Schema::create('customer', function (Blueprint $table) {
   
            $table->bigIncrements('id');

            $table->string('primer_nombre', 255);
            $table->string('segundo_nombre', 255)->nullable();
            $table->string('apellidos', 255);

            $table->string('identificacion', 20);

            $table->string('correo', 255);

            $table->timestamps(1);
            $table->softDeletes('deleted_at', 1);

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customer');
    }
};
