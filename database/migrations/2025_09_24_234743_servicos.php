<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        //
        Schema::create('servicos', function (Blueprint $table) {
        $table->id();
        $table->foreignId('cliente_id')->constrained('clientes')->onDelete('cascade');$table->string('titulo')->nullable();
        $table->string('descricao')->nullable();
        $table->foreignId('endereco_id')->nullable()->constrained('endereco')->onDelete('cascade');    
        $table->timestamps();
});
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
                Schema::dropIfExists('roles');

    }
};
