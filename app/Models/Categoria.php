<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

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

    public function prestadores()
    {
        return $this->hasMany(Prestador::class, 'categoria_id');
    }

    public function clientes()
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
}