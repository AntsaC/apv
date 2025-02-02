<?php

namespace App\Enum;

enum EnergyType : string
{
    case DIESEL = 'diesel';
    case PLUGIN = 'plugin';
    case FUEL = 'fuel';
    case HYBRIDE = 'hybrid';

    public function label() : string {
        return match($this) {
            self::DIESEL => 'Diesel',
            self::PLUGIN => 'Plugin',
            self::FUEL  => 'Essence',
            self::HYBRIDE   => 'Hybride'
        };   
    }
}
