<?php

namespace App\Models;

use App\Casts\ImageCast;
use App\Models\User;
use App\Models\Project;
use App\Models\Talent;
use App\Models\RepliesToSupporterComment;
use Auth;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SupporterComment extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'supporter_comments';

    protected $fillable = [
        'content',
        'image_url',
    ];

    protected $casts = [
        'image_url' => ImageCast::class,
    ];

    protected $dates = ['deleted_at'];

    public static function boot()
    {
        parent::boot();
        static::deleting(function(SupporterComment $supporter_comment){
            $supporter_comment->userSupporterCommentLiked()->delete();
            $supporter_comment->repliesToSupporterComment()->delete();
        });
    }

    public function scopeGetSupporterCommentsByTalent($query)
    {
        return $query->whereIn('project_id', Project::select('id')->where('talent_id', Auth::id()));
    }

    public function scopeGetSupporterCommentsByCompany($query)
    {
        return $query->whereIn('project_id', Project::select('id')
        ->whereIn('talent_id', Talent::select('id')
        ->where('company_id', Auth::id())
        ));
    }

    public function project()
    {
        return $this->belongsTo('App\Models\Project');
    }

    public function userSupporterCommentLiked()
    {
        return $this->hasMany('App\Models\UserSupporterCommentLiked');
    }

    public function likedUsers()
    {
        return $this->belongsToMany('App\Models\User', 'App\Models\UserSupporterCommentLiked');
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function talent()
    {
        return $this->belongsToMany('App\Models\Talent', 'App\Models\RepliesToSupporterComment');
    }

    public function repliesToSupporterComment()
    {
        return $this->hasOne('App\Models\RepliesToSupporterComment');
    }

    public function scopeSearchByWords($query, $words)
    {
        if ($words[0] !== "") {
            foreach ($words as $word) {
                $query->where(function ($query) use ($word) {
                    $query->where('content', 'like', "%$word%")
                        ->orWhereIn('user_id', User::query()->select('users.id')->where('name', 'like', "%$word%"))
                        ->orWhereIn('id', RepliesToSupporterComment::query()->select('supporter_comment_id')->where('content', 'like', "%$word%"))
                        ->orWhereIn('project_id', Project::query()->select('projects.id')->where('title', 'like', "%$word%")
                                                    ->orWhereIn('talent_id', Talent::query()->select('talents.id')->where('name', 'like', "%$word%")));
                });
            }
        }

        return $query;
    }

    public function scopeSearchByProject($query, $project_id)
    {
        if (isset($project_id)) {
            $query->where('project_id', $project_id);
        }
        return $query;
    }

    public function scopeSearchWithPostDates($query, $from_date, $to_date)
    {
        if ($from_date !== null && $to_date !== null){
            $query->whereBetween('created_at', [$from_date, $to_date])
                ->orderBy('created_at', 'asc');
        } elseif ($from_date !== null){
            $query->where('created_at', '>=', $from_date)
                ->orderBy('created_at', 'asc');
        } elseif ($to_date !== null){
            $query->where('created_at', '<=', $to_date)
                ->orderBy('created_at', 'desc');
        }
        return $query;
    }
}
