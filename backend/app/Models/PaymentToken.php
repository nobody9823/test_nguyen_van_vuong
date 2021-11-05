<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PaymentToken extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'payment_id',
        'token',
    ];
    public function payment()
    {
        return $this->belongsTo('App\Models\Payment');
    }
}
