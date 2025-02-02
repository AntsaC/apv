<?php

namespace App\Enum;

enum CustomerType : string
{
    case INDIVIDUAL = 'individual';
    case COMPANY = 'company';

    public function label() : string {
        return match($this) {
            self::INDIVIDUAL => 'Particulier',
            self::COMPANY => 'Société'
        };   
    }
}
