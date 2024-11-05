<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Treino extends Model
{
    use HasFactory;

    protected $table = 'treinos';

    protected $fillable = [
        'descricao',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
    ];

    protected $with = [
        'exercicios_treino',
    ];



    public function exercicios_treino()
    {
        return $this->hasMany(ExercicioTreino::class, 'ref_treino');
    }
}
