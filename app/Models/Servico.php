<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Servico extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'prestador_id',
        'categoria_id',
        'titulo',
        'descricao',
        'tipo_servico',
        'cpf_cnpj_servico',
        'telefone_servico',
        'valor_hora',
        'valor_fixo',
        'tipo_valor',
        'status',
        'verificado',
        'endereco_servico_id',
        'cidade_servico',
        'estado_servico',
        'cep_servico',
        'latitude',
        'longitude',
        'visualizacoes'
    ];

    public function getCpfCnpjAttribute()
    {
        return $this->cpf_cnpj_servico ?? $this->prestador->documento;
    }

    public function getTelefoneAttribute()
    {
        return $this->telefone_servico ?? $this->prestador->telefone;
    }

    public function getEnderecoCompletoAttribute()
    {
        if ($this->enderecoServico) {
            return $this->enderecoServico->formatado;
        }

        if ($this->prestador->endereco) {
            return $this->prestador->endereco->formatado;
        }

        return null;
    }

    public function getCidadeAttribute()
    {
        return $this->cidade_servico ?? $this->prestador->endereco->cidade ?? null;
    }

    public function getEstadoAttribute()
    {
        return $this->estado_servico ?? $this->prestador->endereco->estado ?? null;
    }

    public function getCepAttribute()
    {
        return $this->cep_servico ?? $this->prestador->endereco->cep ?? null;
    }

    public function prestador()
    {
        return $this->belongsTo(Prestador::class);
    }

    public function categoria()
    {
        return $this->belongsTo(Categoria::class);
    }

    public function enderecoServico()
    {
        return $this->belongsTo(Endereco::class, 'endereco_servico_id');
    }

    public function categorias()
    {
        return $this->belongsToMany(Categoria::class, 'servico_categoria');
    }
}
