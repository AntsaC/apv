<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

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
        'invoiceComment',
        'vn_seller_id',
        'vo_seller_id',
        'intermediate_seller_id',
        'customer_id'
    ];

    public function vnSeller() : BelongsTo {
        return $this->belongsTo(Seller::class);
    }

    public function voSeller() : BelongsTo {
        return $this->belongsTo(Seller::class);
    }

    public function intermediateSeller() : BelongsTo {
        return $this->belongsTo(Seller::class);
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

}
