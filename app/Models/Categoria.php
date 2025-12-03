<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Categoria extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'categorias';

    protected $fillable = [
        'nome',
        'icone',      
        'slug',       
        'descricao',  
        'ativo',      
        'ordem'       
    ];

    protected $casts = [
        'ativo' => 'boolean',
        'ordem' => 'integer'
    ];
    
    public function setNomeAttribute($value)
    {
        $this->attributes['nome'] = $value;
        $this->attributes['slug'] = Str::slug($value);
    }

    public function servicos(): HasMany
    {
        return $this->hasMany(Servico::class, 'categoria_id');
    }

    public function servicosAdicionais(): BelongsToMany
    {
        return $this->belongsToMany(Servico::class, 'servico_categoria');
    }


    public function prestadores(): HasMany
    {
        return $this->hasMany(Prestador::class, 'categoria_id');
    }

    function clientes(): HasMany
    {
        return $this->hasMany(Cliente::class, 'categoria_id');
    }

    public function scopeAtivas($query)
    {
        return $query->where('ativo', true);
    }

    public function scopeOrdenadas($query)
    {
        return $query->orderBy('ordem')->orderBy('nome');
    }

    public function scopeComServicosAtivos($query)
    {
        return $query->whereHas('servicos', function($q) {
            $q->where('status', 'ativo')
              ->where('verificado', true);
        });
    }

   
    public function getQuantidadeServicosAtivosAttribute(): int
    {
        return $this->servicos()
            ->where('status', 'ativo')
            ->where('verificado', true)
            ->count();
    }

   
    public function getQuantidadePrestadoresAtivosAttribute(): int
    {
        return $this->prestadores()
            ->whereHas('user', function($query) {
                $query->where('ativo', true);
            })
            ->count();
    }

    public function getUrlAttribute(): string
    {
        return route('servicos.index', ['categoria' => $this->slug]);
    }

    public function getTemServicosAtivosAttribute(): bool
    {
        return $this->quantidade_servicos_ativos > 0;
    }

  
    public function getNomeComIconeAttribute(): string
    {
        if ($this->icone) {
            return "<i class='{$this->icone}'></i> {$this->nome}";
        }
        return $this->nome;
    }


    public function getAllServicosAttribute()
    {
        $servicosPrincipais = $this->servicos()
            ->where('status', 'ativo')
            ->where('verificado', true)
            ->get();
            
        $servicosAdicionais = $this->servicosAdicionais()
            ->where('status', 'ativo')
            ->where('verificado', true)
            ->get();
            
        return $servicosPrincipais->merge($servicosAdicionais)->unique('id');
    }

    public function getServicosRecomendados($limit = 6)
    {
        return $this->servicos()
            ->where('status', 'ativo')
            ->where('verificado', true)
            ->orderBy('visualizacoes', 'desc')
            ->orderBy('created_at', 'desc')
            ->limit($limit)
            ->get();
    }

   
    public function getPrestadoresRecomendados($limit = 6)
    {
        return $this->prestadores()
            ->whereHas('servicos', function($q) {
                $q->where('status', 'ativo')
                  ->where('verificado', true);
            })
            ->withCount(['servicos' => function($q) {
                $q->where('status', 'ativo')
                  ->where('verificado', true);
            }])
            ->orderBy('servicos_count', 'desc')
            ->limit($limit)
            ->get();
    }

   function contarServicosPorStatus(): array
    {
        return [
            'ativos' => $this->servicos()->where('status', 'ativo')->count(),
            'pendentes' => $this->servicos()->where('status', 'pendente')->count(),
            'rascunhos' => $this->servicos()->where('status', 'rascunho')->count(),
            'inativos' => $this->servicos()->where('status', 'inativo')->count(),
            'rejeitados' => $this->servicos()->where('status', 'rejeitado')->count(),
        ];
    }
}