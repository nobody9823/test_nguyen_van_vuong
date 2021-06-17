<?php

namespace App\Models;

use Carbon\Carbon;
use Faker\Calculator\Ean;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Request;

class WorkShift extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'date'
    ];

    public function talent()
    {
        return $this->belongsTo(Talent::class);
    }

    public function workAttendance()
    {
        //今後hasmanyにする可能性あり
        return $this->hasOne(WorkAttendance::class);
    }

    public function scopeGetWorkShiftByTalent($query, $target_month)
    {
        return $this->where('talent_id', Auth::id())
            ->whereDate('date', '>=', $target_month->firstOfMonth())
            ->whereDate('date', '<=', $target_month->lastOfMonth())
            ->with('workAttendance')
            ->get();
    }

    public function scopeGetWorkShiftByCompany($query, $talent, $target_month)
    {
        return $this->where('talent_id', $talent->id)
            ->whereDate('date', '>=', $target_month->firstOfMonth())
            ->whereDate('date', '<=', $target_month->lastOfMonth())
            ->with('workAttendance')
            ->get();
    }
}
