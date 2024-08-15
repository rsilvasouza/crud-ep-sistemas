<?php

namespace App\Enums;


enum ComoNosConheceu
{
    case INDICACAO;
    case INTERNET;
    case ANUNCIOS;
    case EVENTOS;
    case BLOG;
    case OUTROS;

    public static function getComoNosConheceu(): array
    {
        return array_column(ComoNosConheceu::cases(), 'name');
    }
}
