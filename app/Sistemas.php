<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Sistemas extends Model
{
    use SoftDeletes;
    
    protected $fillable = [
        'descricao', 'sigla', 'email', 'url'
    ];
}
