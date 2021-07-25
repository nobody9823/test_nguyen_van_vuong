<?php

namespace App\Models;

use App\Casts\ImageCast;
use App\Casts\HashMake;
use App\Notifications\ResetPasswordNotification;
use Auth;
use App\Traits\SearchFunctions;
use App\Traits\SortBySelected;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Storage;

class User extends Authenticatable
{
    use HasFactory, Notifiable, SoftDeletes, SearchFunctions, SortBySelected;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'email_verified_at',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'image_url' => ImageCast::class,
        'password' => HashMake::class,
    ];

    protected $dates = ['deleted_at'];

    public static function boot()
    {
        parent::boot();

        static::deleting(function (User $user) {
            $user->snsUser()->delete();
            $user->address()->delete();
            $user->snsLink()->delete();
            $user->identification()->delete();
            $user->profile()->delete();

            $project_ids = Project::where('user_id', $user->id)->pluck('id')->toArray();
            ProjectFile::whereIn('project_id', $project_ids)->delete();
            Project::destroy($project_ids);

            // 中間テーブルの削除
            UserProjectLiked::where('user_id', $user->id)
                ->update(['deleted_at' => Carbon::now()]);
            UserProjectSupported::where('user_id', $user->id)
                ->update(['deleted_at' => Carbon::now()]);
            Payment::where('inviter_id', $user->id)
                ->update(['inviter_id' => null]);
            $payment_ids = $user->payments()->pluck('id');
            $comment_ids = Comment::whereIn('payment_id', $payment_ids)->pluck('id')->toArray();
            Reply::whereIn('comment_id', $comment_ids)->delete();
            Comment::destroy($comment_ids);
            MessageContent::whereIn('payment_id', $payment_ids)->delete();
            PlanPaymentIncluded::whereIn('payment_id', $payment_ids)->delete();
            Payment::destroy($payment_ids);
        });
    }

    public function sendPasswordResetNotification($token)
    {
        $this->notify(new ResetPasswordNotification($token));
    }

    // NOTICE デザインにないのでコメントアウト
    // public function userCommentLiked()
    // {
    //     return $this->belongsToMany('App\Models\Comment', 'App\Models\UserCommentLiked');
    // }

    public function projects()
    {
        return $this->hasMany('App\Models\Project');
    }

    public function payments()
    {
        return $this->hasMany('App\Models\Payment');
    }

    public function invitedPayments()
    {
        return $this->hasMany('App\Models\Payment', 'inviter_id', 'id');
    }

    public function invitedPlanPaymentIncluded()
    {
        return $this->hasManyThrough(
            'App\Models\PlanPaymentIncluded',
            'App\Models\Payment',
            'inviter_id',
            'payment_id',
            'id',
            'id'
        );
    }

    public function likedProjects()
    {
        return $this->belongsToMany('App\Models\Project', 'user_project_liked')
            ->using('App\Models\UserProjectLiked')
            ->withTimestamps();
    }

    public function supportedProjects()
    {
        return $this->belongsToMany('App\Models\Project', 'user_project_supported')
            ->using('App\Models\UserProjectSupported')
            ->withTimestamps();
    }

    public function address()
    {
        return $this->hasOne('App\Models\Address');
    }

    public function profile()
    {
        return $this->hasOne('App\Models\Profile');
    }

    public function snsUser()
    {
        return $this->hasOne('App\Models\SnsUser');
    }

    public function replies()
    {
        return $this->hasMany('App\Models\Reply');
    }

    public function snsLink()
    {
        return $this->hasOne('App\Models\SnsLink');
    }

    public function identification()
    {
        return $this->hasOne('App\Models\Identification');
    }

    //--------------- local scopes -------------
    public function scopeGetUsers()
    {
        return $this->paginate(10);
    }

    public function scopeSearch($query)
    {
        if ($this->getSearchWordInArray()) {
            foreach ($this->getSearchWordInArray() as $word) {
                $query->where(function ($query) use ($word) {
                    $query->Where('name', 'like', "%$word%")->orWhere('email', 'like', "%$word%");
                });
            }
        }
    }

    public function scopeSearchUsersToArray($query, $word): array
    {
        return $query->where('name', 'like', "%$word%")->pluck('id')->toArray();
    }

    public function scopePluckNameAndId($query)
    {
        return $query->pluck('name', 'id');
    }

    // inviter_idが一致するpaymentsに紐づくplan_payment_includedのquantityカラムの合計を集計して降順に並び替え
    public function scopeGetInvitersRankedByInvitedUsers($query, $project_id)
    {
        return $query->withSum(['invitedPlanPaymentIncluded' => function ($query) use ($project_id) {
            $query->where('payments.project_id', $project_id);
        }], 'quantity')
        ->whereIn('id', Payment::select('inviter_id')->whereIn(
            'project_id',
            Project::select('id')->where('id', $project_id)->pluck('id')->toArray()
        ))
        ->orderBy('invited_plan_payment_included_sum_quantity', 'DESC');
    }

    // inviter_idが一致するpaymentsの支援総額から降順に並び替え
    public function scopeGetInvitersRankedByInvitedTotalAmount($query, $project_id)
    {
        return $query->withSum(['invitedPayments' => function ($query) use ($project_id) {
            $query->where('project_id', $project_id);
        }], 'price')
        ->whereIn('id', Payment::select('inviter_id')->whereIn(
            'project_id',
            Project::select('id')->where('id', $project_id)->pluck('id')->toArray()
        ))
        ->orderBy('invited_payments_sum_price', 'DESC');
    }

    public function scopeGetInviterFromInviterCode($query, $inviter_code)
    {
        return $query->whereIn(
            'id',
            Profile::select('user_id')->where(
                'inviter_code',
                $inviter_code
            )
        );
    }
    //--------------- local scopes -------------



    //--------------- functions -------------
    public function deleteImageIfSample(): void
    {
        if (strpos($this->image_url, 'sampleImage') === false) {
            Storage::delete($this->image_url);
        };
    }

    public function saveProfile(array $value) :void
    {
        if (isset($this->profile)) {
            $this->profile()->save($this->profile->fill($value));
        } else {
            $profile = new Profile();
            $this->profile()->save($profile->fill($value));
        }
    }

    public function saveAddress(array $value) :void
    {
        if (isset($this->address)) {
            $this->address()->save($this->address->fill($value));
        } else {
            $address = new Address();
            $this->address()->save($address->fill($value));
        }
    }

    public function saveSnsLink(array $value) :void
    {
        if (isset($this->snsLink)) {
            $this->snsLink()->save($this->snsLink->fill($value));
        } else {
            $snsLink = new SnsLink();
            $this->snsLink()->save($snsLink->fill($value));
        }
    }
    //--------------- functions -------------
}
