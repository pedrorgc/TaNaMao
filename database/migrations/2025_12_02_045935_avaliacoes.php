<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('avaliacoes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('servico_id')->constrained()->onDelete('cascade');
            $table->foreignId('cliente_id')->constrained('clientes')->onDelete('cascade');
            $table->foreignId('prestador_id')->constrained('prestadores')->onDelete('cascade');
            $table->integer('nota')->default(0);
            $table->string('titulo')->nullable();
            $table->text('comentario')->nullable();
            $table->boolean('recomenda')->default(true);
            $table->date('data_servico')->nullable();
            $table->timestamps();
            
            $table->index(['servico_id', 'cliente_id']);
            $table->index('prestador_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('avaliacoes');
    }
};