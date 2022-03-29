<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AddressPayment extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'address_payment';
    protected $dates = ['deleted_at'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'address_id',
        'payment_id',
    ];

    public function addresses()
    {
        return $this->belongsTo('App\Models\Address');
    }

    public function payments()
    {
        return $this->belongsTo('App\Models\Payment');
    }
}
