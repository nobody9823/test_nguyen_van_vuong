<?php

namespace App\Models;

use App\Casts\ImageCast;
use App\Casts\HashMake;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Storage;

class User extends Authenticatable
{
    use HasFactory, Notifiable, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'image_url',
        'email_verified_at',
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
            $user->userAddresses()->delete();
            $user->snsLinks()->delete();

            // 中間テーブルの削除
            UserProjectLiked::where('user_id', $user->id)
                ->update(['deleted_at' => Carbon::now()]);
            $comment_ids = Comment::where('user_id', $user->id)->pluck('id')->toArray();
            Reply::whereIn('comment_id', $comment_ids)->delete();
            Comment::destroy($comment_ids);
            UserPlanBilling::where('user_id', $user->id)
                ->update(['deleted_at' => Carbon::now()]);
        });
    }

    public function supportComments()
    {
        return $this->hasMany('App\Models\SupporterComment');
    }

    public function userSupporterCommentLiked()
    {
        return $this->belongsToMany('App\Models\SupporterComment', 'App\Models\UserSupporterCommentLiked');
    }

    public function plans()
    {
        return $this->belongsToMany('App\Models\Plan', 'user_plan_cheering')
            ->using('App\Models\UserPlanCheering')
            ->withPivot('selected_option')
            ->withTimestamps();
    }

    public function projects()
    {
        return $this->belongsToMany('App\Models\Project', 'user_project_liked')
            ->using('App\Models\UserProjectLiked')
            ->withTimestamps();
    }

    public function address()
    {
        return $this->hasOne('App\Models\Address');
    }

    public function userDetail()
    {
        return $this->hasOne('App\Models\UserDetail');
    }

    public function snsUser()
    {
        return $this->hasOne('App\Models\SnsUser');
    }

    public function comments()
    {
        return $this->hasMany('App\Models\Comment');
    }

    public function userPlanBilling()
    {
        return $this->hasMany('App\Models\UserPlanBilling');
    }

    public function replies()
    {
        return $this->hasMany('App\Models\Reply');
    }

    public function snsLinks()
    {
        return $this->hasMany('App\Models\SnsLink');
    }

    //--------------- local scopes -------------
    public function scopeGetUsers()
    {
        return $this->paginate(10);
    }

    public function scopeSearchWord($query, $words)
    {
        return $query->where(function ($user) use ($words) {
            foreach ($words as $word) {
                $user->Where('name', 'like', "%$word%");
                $user->orWhere('email', 'like', "%$word%");
            }
        })->paginate(10);
    }

    public function scopeSearchUsersToArray($query, $word): array
    {
        return $query->where('name', 'like', "%$word%")->pluck('id')->toArray();
    }
    //--------------- local scopes -------------



    //--------------- functions -------------
    public function deleteImageIfSample(): void
    {
        if (strpos($this->image_url, 'sampleImage') === false) {
            Storage::delete($this->image_url);
        };
    }
    //--------------- functions -------------
}
