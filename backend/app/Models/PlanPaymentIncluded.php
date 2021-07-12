<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\Pivot;

class PlanPaymentIncluded extends Pivot
{
    use HasFactory;

    /**
     * @var string
     */
    protected $table = 'plan_payment_included';

    public function plan()
    {
        return $this->belongsTo('App\Models\Plan', 'plan_id');
    }

    public function payment()
    {
        return $this->belongsTo('App\Models\Payment', 'payment_id');
    }
}
