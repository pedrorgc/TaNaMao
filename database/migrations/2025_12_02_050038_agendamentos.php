<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('agendamentos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('servico_id')->constrained()->onDelete('cascade');
            $table->foreignId('cliente_id')->constrained('clientes')->onDelete('cascade');
            $table->foreignId('prestador_id')->constrained('prestadores')->onDelete('cascade');
            $table->dateTime('data_hora');
            $table->dateTime('data_hora_fim')->nullable();
            $table->enum('status', ['pendente', 'confirmado', 'cancelado', 'concluido'])->default('pendente');
            $table->text('observacoes')->nullable();
            $table->json('endereco')->nullable();
            $table->decimal('valor', 10, 2)->nullable();
            $table->integer('duracao')->nullable(); 
            $table->string('pagamento_status')->default('pendente');
            $table->string('pagamento_metodo')->nullable();
            $table->foreignId('avaliacao_id')->nullable()->constrained('avaliacoes')->nullOnDelete();
            $table->timestamps();
            
            $table->index(['prestador_id', 'data_hora']);
            $table->index(['cliente_id', 'status']);
            $table->index('status');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('agendamentos');
    }
};