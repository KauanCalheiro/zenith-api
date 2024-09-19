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
        Schema::create('turmas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('ref_pessoa')->constrained('pessoas')->onDelete('cascade');
            $table->foreignId('ref_ocorrencia_aula')->constrained('ocorrencias_aula')->onDelete('cascade');
            $table->timestamps();
        });

        Schema::table('turmas', function (Blueprint $table) {
            $table->index('ref_pessoa');
            $table->index('ref_ocorrencia_aula');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('turmas');
    }
};
