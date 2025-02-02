<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Customer extends Model
{
    public function businessAccount() : BelongsTo {
        return $this->belongsTo(Account::class);
    }

    public function eventAccount() : BelongsTo {
        return $this->belongsTo(Account::class);
    }

    public function lastEventAccount() : BelongsTo {
        return $this->belongsTo(Account::class);
    }
}
