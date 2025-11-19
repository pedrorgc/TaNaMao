<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Endereco extends Model
{
    use HasFactory;

     protected $table = 'enderecos';

    protected $fillable = [
        'cep',
        'logradouro',
        'numero',
        'complemento',
        'bairro',
        'cidade',
        'estado',
    ];
    
    public function cliente()
    {
        return $this->hasOne(Cliente::class);
    }

     public function prestador()
    {
        return $this->hasOne(Prestador::class);
    }

}
