<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cidade extends Model
{
    use HasFactory;

    protected $table = 'cidades_br';
    public $timestamps = false;
    protected $fillable = ['nomeCidade', 'nomeEstado'];
}
