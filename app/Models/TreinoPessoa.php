<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TreinoPessoa extends Model
{
    use HasFactory;

    protected $table = 'treino_pessoa';

    protected $fillable = [
        'ref_treino',
        'ref_pessoa',
        'data_inicial',
        'data_final',
    ];

    public function treino()
    {
        return $this->belongsTo(Treino::class, 'ref_treino');
    }

    public function pessoa()
    {
        return $this->belongsTo(Pessoa::class, 'ref_pessoa');
    }
}
