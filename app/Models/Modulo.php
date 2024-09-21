<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Modulo extends Model
{
    use HasFactory;

    public $table = 'modulos';
    public $primaryKey = 'id';

    public $fillable = [
        'descricao',
        'path',
    ];

    public $hidden = [
        'created_at',
        'updated_at',
    ];
}
