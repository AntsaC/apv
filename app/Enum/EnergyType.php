<?php

namespace App\Enum;

enum EnergyType : string
{
    case DIESEL = 'DIESEL';
    case PLUGIN = 'PLUG-IN';
    case FUEL = 'ESSENCE';
    case HYBRIDE = 'HYBRIDE';

    public function label() : string {
        return match($this) {
            self::DIESEL => 'Diesel',
            self::PLUGIN => 'Plugin',
            self::FUEL  => 'Essence',
            self::HYBRIDE   => 'Hybride'
        };   
    }
}
