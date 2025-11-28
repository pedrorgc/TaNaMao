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
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function endereco()
    {
        return $this->belongsTo(Endereco::class);
    }

    public function categoria()
    {
        return $this->belongsTo(Categoria::class, 'categoria_id');
    }
}
