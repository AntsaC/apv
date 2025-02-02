<?php

namespace App\Enum;

enum EventOrigin : string
{
    case ATELIER = 'atelier';
    case NEW = 'new';
    case USED = 'used';

    public function label() : string {
        return match($this) {
            self::ATELIER => 'Atelier',
            self::NEW => 'Véhicule neuf',
            self::USED  => 'Véhicule d\'occasion'
        };   
    }
}
