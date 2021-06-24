<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory, SoftDeletes;

    public function user()
    {
        return $this->belongsTo('App\Models\Users');
    }

    public function payments()
    {
        return $this->belongsToMany('App\Models\Payment', 'App\Models\PlanPaymentIncluded');
    }
}
