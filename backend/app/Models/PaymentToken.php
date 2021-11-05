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
        'order_id',
        'access_id',
        'access_pass',
        'job_cd',
    ];
    public function payment()
    {
        return $this->belongsTo('App\Models\Payment');
    }
}
