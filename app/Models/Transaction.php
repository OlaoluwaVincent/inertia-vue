<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = [
        "amount",
        "transaction_id",
        "customer_id",
        "transaction_ref",
        "status",
        "user_id",
        "channel",
    ];

    public function user()
    {
        $this->belongsTo(User::class);
    }
}
