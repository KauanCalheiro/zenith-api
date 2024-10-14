<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Exercicio extends Model
{
    use HasFactory;

    protected $table = 'exercicios';

    protected $fillable = [
        'nome',
        'video',
        'descricao',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
    ];
}
