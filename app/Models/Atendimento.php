<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Atendimento extends Model
{
    use HasFactory;
    protected $fillable = ['id', 'cep', 'nome', 'cpf', 'whatsapp', 'contato', 'como_nos_conheceu'];

}
