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
        Schema::create('ocorrencias_aula', function (Blueprint $table) {
            $table->id();
            $table->foreignId('ref_aula')->constrained('aulas');
            $table->integer('vagas')->nullable();
            $table->string('dia_semana', 45)->nullable();
            $table->timestamp('horario_inicial')->nullable();
            $table->timestamp('horario_final')->nullable();
            $table->string('profissional', 45)->nullable();
            $table->timestamps();
        });

        Schema::table('ocorrencias_aula', function (Blueprint $table) {
            $table->index('ref_aula');
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ocorrencias_aula');
    }
};
