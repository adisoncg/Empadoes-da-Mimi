<?php

namespace App\Models;

use App\Http\Controllers\UsuarioController;
use Illuminate\Auth\EloquentUserProvider;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Usuario extends Model
{
    use HasFactory;

    protected $fillable = [
        'nome', 'email', 'senha', 'status', 'tipo'
    ];

    
    
}

