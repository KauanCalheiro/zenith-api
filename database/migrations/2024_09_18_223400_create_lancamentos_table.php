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
        Schema::create('lancamentos', function (Blueprint $table) {
            $table->id();
            $table->string('descricao', 45);
            $table->double('valor');
            $table->foreignId('ref_titulo')->constrained('titulos')->onDelete('cascade');
            $table->timestamp('dt_lancamento');
            $table->timestamps();
        });

        Schema::table('lancamentos', function (Blueprint $table) {
            $table->index('ref_titulo');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lancamentos');
    }
};
