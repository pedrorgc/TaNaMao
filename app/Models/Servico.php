<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Servico extends Model
{
    protected $table = 'servicos';

    protected $fillable = [
        'cliente_id',
        'prestador_id',
        'titulo',
        'descricao',
        'valor',
        'status',
        'endereco_id',
    ];

    public function cliente() {
        return $this->belongsTo(Cliente::class);
    }

    public function prestador() {
        return $this->belongsTo(Prestador::class);
    }

    public function endereco() {
        return $this->belongsTo(Endereco::class);
    }
}
