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
        Schema::create('contratos', function (Blueprint $table) {
            $table->id();
            $table->string('numero', 45);
            $table->string('status', 45);
            $table->foreignId('ref_pessoa')->constrained('pessoas')->onDelete('cascade');
            $table->timestamp('dt_inicio');
            $table->timestamp('dt_fim')->nullable();
            $table->timestamps();
        });

        Schema::table('contratos', function (Blueprint $table) {
            $table->index('ref_pessoa');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contratos');
    }
};
