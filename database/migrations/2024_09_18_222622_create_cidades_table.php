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
        Schema::create('cidades', function (Blueprint $table) {
            $table->id();
            $table->foreignId('ref_estado')->constrained('estados');
            $table->string('nome', 45)->nullable();
            $table->timestamps();
        });

        Schema::table('cidades', function (Blueprint $table) {
            $table->index('ref_estado');
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cidades');
    }
};
