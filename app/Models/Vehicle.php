<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{
    protected $fillable = [
        'circulationDate',
        'purchaseDate',
        'lastEventDate',
        'brand',
        'model',
        'version',
        'vin',
        'immatriculation',
        'kilometrage',
        'energy',
        'saleType',
        'saleFileNumber',
        'eventDate',
        'eventOrigin',
        'invoiceComment'
    ];
}
