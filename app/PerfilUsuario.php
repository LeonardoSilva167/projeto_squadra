<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PerfilUsuario extends Model
{
    use SoftDeletes;
        
    protected $fillable = [
        'descricao', 'permissao',
    ];
}
