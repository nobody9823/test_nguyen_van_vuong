<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MessageContent extends Model
{
    use HasFactory,SoftDeletes;

    protected $table = 'message_contents';
    protected $touches = ['userPlanBilling'];
    protected $dates = ['deleted_at'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_plan_billing_id',
    ];

    public function userPlanBilling()
    {
        return $this->belongsTo(UserPlanBilling::class, 'user_plan_billing_id');
    }

    public function scopeReadByUser($query)
    {
        return $query->whereIn('message_contributor', ['タレント','管理者'])->where('is_read', false)->update(['is_read' => true]);
    }

    public function scopeReadByTalent($query)
    {
        return $query->where('message_contributor', '支援者')->where('is_read', false)->update(['is_read' => true]);
    }

    public function scopeCheckReadByUser($query)
    {
        return $query->whereIn('message_contributor', ['タレント','管理者'])->where('is_read', false)->exists();
    }

    public function scopeCheckReadByCompany($query)
    {
        return $query->where('message_contributor', '支援者')->where('is_read', false)->exists();
    }

    public function scopeCheckReadByTalent($query)
    {
        return $query->where('message_contributor', '支援者')->where('is_read', false)->exists();
    }
}
