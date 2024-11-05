<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Pessoa extends Model
{
    use HasFactory, Notifiable;

    public $table = 'pessoas';
    public $primaryKey = 'id';

    public $fillable = [
        'nome',
        'email',
        'email_verified_at',
        'password',
        'dt_nascimento',
        'cpf',
        'endereco',
        'telefone',
        'genero',
        'ref_cidade',
    ];

    public $hidden = [
        'password',
    ];
}
