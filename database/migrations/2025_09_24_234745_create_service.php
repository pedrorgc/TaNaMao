<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('servicos', function (Blueprint $table) {
            $table->id();
            
            $table->foreignId('prestador_id')
                ->constrained('prestadores')
                ->onDelete('cascade');
            
            $table->foreignId('categoria_id')
                ->constrained('categorias')
                ->onDelete('restrict');
            
            $table->string('titulo');
            $table->string('slug')->unique();
            $table->text('descricao');
            $table->string('tipo_servico');
            
            $table->string('cpf_cnpj_servico')->nullable()->comment('CPF/CNPJ específico para este serviço');
            $table->string('telefone_servico')->nullable()->comment('Telefone específico para este serviço');
            
            $table->decimal('valor_hora', 10, 2)->nullable();
            $table->decimal('valor_fixo', 10, 2)->nullable();
            $table->enum('tipo_valor', ['hora', 'fixo', 'orcamento'])->default('orcamento');
            
            $table->enum('status', ['rascunho', 'pendente', 'ativo', 'inativo', 'rejeitado'])->default('rascunho');
            $table->boolean('verificado')->default(false);
            
            $table->foreignId('endereco_servico_id')
                ->nullable()
                ->constrained('enderecos')
                ->nullOnDelete()
                ->comment('Endereço específico para este serviço');
            
            $table->string('cidade_servico')->nullable()->comment('Para busca rápida');
            $table->string('estado_servico', 2)->nullable()->comment('Para busca rápida');
            $table->string('cep_servico', 9)->nullable()->comment('Para busca rápida');
            
            $table->decimal('latitude', 10, 8)->nullable();
            $table->decimal('longitude', 11, 8)->nullable();
            
            $table->integer('visualizacoes')->default(0);
            
            $table->timestamps();
            $table->softDeletes();
            
            $table->index(['status', 'verificado']);
            $table->index(['cidade_servico', 'estado_servico']);
            $table->index('tipo_servico');
            $table->index('tipo_valor');
            $table->index('prestador_id');
            $table->index('categoria_id');
        });
        
        Schema::create('servico_categoria', function (Blueprint $table) {
            $table->id();
            $table->foreignId('servico_id')
                ->constrained('servicos')
                ->onDelete('cascade');
            $table->foreignId('categoria_id')
                ->constrained('categorias')
                ->onDelete('cascade');
            $table->timestamps();
            
            $table->unique(['servico_id', 'categoria_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('servico_categoria');
        Schema::dropIfExists('servicos');
    }
};