<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExercicioTreino extends Model
{
    use HasFactory;

    protected $table = 'exercicio_treino';

    protected $fillable = [
        "ref_exercicio",
        "ref_treino",
        "grupo",
        "num_series",
        "num_repeticoes",
        "carga",
        "observacao",
    ];

    protected $with = [
        'exercicio',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
    ];

    public function exercicio()
    {
        return $this->belongsTo(Exercicio::class, 'ref_exercicio');
    }
}
