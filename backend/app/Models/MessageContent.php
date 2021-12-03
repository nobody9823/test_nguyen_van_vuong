<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MessageContent extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'message_contents';
    protected $dates = ['deleted_at'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'payment_id',
    ];

    public function payment()
    {
        return $this->belongsTo(Payment::class, 'payment_id');
    }

    public function scopeNotRead($query, $guard)
    {
        switch ($guard) {
            case "支援者":
                return $query->whereIn('message_contributor', ['実行者', '管理者'])->where('is_read', false);
            case "実行者":
                return $query->where('message_contributor', '支援者')->where('is_read', false);
        }
    }

    public function scopeRead($query, $guard)
    {
        return $query->notRead($guard)->update(['is_read' => true]);
    }

    public function scopeCheckRead($query, $guard)
    {
        return $query->notRead($guard)->exists();
    }
}
