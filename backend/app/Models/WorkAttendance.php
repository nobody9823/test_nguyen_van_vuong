<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WorkAttendance extends Model
{
    use HasFactory;

    protected $fillable = [
        'work_shift_id',
        'date',
    ];

    public function workShift()
    {
        return $this->belongsTo(WorkShift::class);
    }
}
