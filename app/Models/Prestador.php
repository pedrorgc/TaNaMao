<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prestador extends Model
{
    use HasFactory;

    protected $table = 'prestadores';

    protected $fillable = [
        'user_id',
        'documento',
        'telefone',
        'categoria_id',
        'endereco_id',
        'descricao'
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function categoria()
    {
        return $this->belongsTo(Categoria::class);
    }

    public function endereco()
    {
        return $this->belongsTo(Endereco::class);
    }

    public function servicos()
    {
        return $this->hasMany(Servico::class);
    }
}
