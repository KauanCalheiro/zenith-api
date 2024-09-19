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
        Schema::create('aula_plano', function (Blueprint $table) {
            $table->foreignId('ref_aula')->constrained('aulas')->onDelete('cascade');
            $table->foreignId('ref_plano')->constrained('planos')->onDelete('cascade');
            $table->timestamps();
            $table->primary(['ref_aula', 'ref_plano']);
        });

        Schema::table('aula_plano', function (Blueprint $table) {
            $table->index('ref_plano');
            $table->index('ref_aula');
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('aula_plano');
    }
};
