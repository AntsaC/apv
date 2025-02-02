<?php

namespace App\Enum;

enum EnergyType : string
{
    case DIESEL = 'DIESEL';
    case PLUGIN = 'PLUG-IN';
    case FUEL = 'ESSENCE';
    case HYBRIDE = 'HYBRIDE';
    case ELECTRIC = 'ELECTRIQUE';

}
