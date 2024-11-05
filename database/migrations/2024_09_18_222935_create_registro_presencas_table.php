<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('registro_presencas', function (Blueprint $table) {
            $table->id();
            $table->string('dt_entrada', 45);
            $table->foreignId('ref_pessoa')->constrained('pessoas');
            $table->timestamps();
        });

        Schema::table('registro_presencas', function (Blueprint $table) {
            $table->index('ref_pessoa');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('registro_presencas');
    }
};
