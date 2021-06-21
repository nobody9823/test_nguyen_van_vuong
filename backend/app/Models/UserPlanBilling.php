<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class UserPlanBilling extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'user_plan_billing';

    public function users()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function plans()
    {
        return $this->belongsTo('App\Models\Plan');
    }
}
