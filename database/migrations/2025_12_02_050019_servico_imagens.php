<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('servico_imagens', function (Blueprint $table) {
            $table->id();
            $table->foreignId('servico_id')->constrained()->onDelete('cascade');
            $table->string('caminho');
            $table->string('nome')->nullable();
            $table->string('tipo')->nullable();
            $table->integer('tamanho')->nullable();
            $table->integer('ordem')->default(0);
            $table->boolean('destaque')->default(false);
            $table->timestamps();
            
            $table->index('servico_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('servico_imagens');
    }
};