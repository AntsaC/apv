<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Customer extends Model
{
    use HasFactory;
    protected $fillable = [
        'cardNumber',
        'civility',
        'firstName',
        'lastName',
        'address',
        'additionnalAdress',
        'city',
        'homePhone',
        'portablePhone',
        'jobPhone',
        'email',
        'type',
        'business_account_id',
        'event_account_id',
        'last_event_account_id',
        'created_at',
        'postalCode'
    ];

    public function businessAccount() : BelongsTo {
        return $this->belongsTo(Account::class);
    }

    public function eventAccount() : BelongsTo {
        return $this->belongsTo(Account::class);
    }

    public function lastEventAccount() : BelongsTo {
        return $this->belongsTo(Account::class);
    }

    public function vehicles()
    {
        return $this->hasMany(Vehicle::class);
    }

    protected function fullName(): Attribute
    {
        return Attribute::make(
            get: fn () => ($this->civility . ' ' . $this->firstName . ' ' . $this->lastName),
        );
    }

}
