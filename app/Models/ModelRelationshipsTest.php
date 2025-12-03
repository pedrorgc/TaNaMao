<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Categoria;
use App\Models\Servico;
use App\Models\Prestador;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ModelRelationshipsTest extends TestCase
{
    use RefreshDatabase;

    public function categoria_tem_relacionamento_com_servicos()
    {
        $categoria = Categoria::factory()->create();
        
        $user = User::factory()->create();
        $prestador = Prestador::factory()->create(['user_id' => $user->id, 'categoria_id' => $categoria->id]);
        
        $servico = Servico::factory()->create([
            'categoria_id' => $categoria->id,
            'prestador_id' => $prestador->id,
            'status' => 'ativo',
            'verificado' => true,
        ]);
        
        $this->assertInstanceOf(Servico::class, $categoria->servicos->first());
        $this->assertEquals(1, $categoria->servicos->count());
        $this->assertEquals($servico->id, $categoria->servicos->first()->id);
    }

    public function servico_pertence_a_categoria()
    {
        $categoria = Categoria::factory()->create();
        
        
        $user = User::factory()->create();
        $prestador = Prestador::factory()->create(['user_id' => $user->id]);
        
        $servico = Servico::factory()->create([
            'categoria_id' => $categoria->id,
            'prestador_id' => $prestador->id,
        ]);
        
        $this->assertInstanceOf(Categoria::class, $servico->categoria);
        $this->assertEquals($categoria->id, $servico->categoria->id);
    }
}