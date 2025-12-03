<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('categorias', function (Blueprint $table) {
            $table->id();
            $table->string('nome')->unique();
            $table->string('slug')->unique()->nullable();
            $table->string('icone')->nullable();
            $table->text('descricao')->nullable();
            $table->boolean('ativo')->default(true);
            $table->integer('ordem')->default(0);
            $table->timestamps();
            $table->softDeletes();
            
            $table->index('ativo');
            $table->index('ordem');
            $table->index('slug');
        });
    }

    
    public function down(): void
    {
        Schema::dropIfExists('categorias');
    }
};