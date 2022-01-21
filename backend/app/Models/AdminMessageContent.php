<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AdminMessageContent extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'admin_message_contents';
    protected $dates = ['deleted_at'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function scopeNotRead($query, $guard)
    {
        switch ($guard) {
            case "ユーザー":
                return $query->where('message_contributor', '管理者')->where('is_read', false);
            case "管理者":
                return $query->where('message_contributor', 'ユーザー')->where('is_read', false);
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
