<?php

// @formatter:off
/**
 * A helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */


namespace App\Models{
/**
 * App\Models\ActivityReport
 *
 * @property int $id
 * @property int $project_id
 * @property string $title
 * @property string $content
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\ActivityReportImage[] $activityReportImages
 * @property-read int|null $activity_report_images_count
 * @property-read \App\Models\Project $project
 * @method static \Illuminate\Database\Eloquent\Builder|ActivityReport getActivityReports($project_id)
 * @method static \Illuminate\Database\Eloquent\Builder|ActivityReport getActivityReportsByCompany($project_id)
 * @method static \Illuminate\Database\Eloquent\Builder|ActivityReport getActivityReportsByTalent($project_id)
 * @method static \Illuminate\Database\Eloquent\Builder|ActivityReport newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ActivityReport newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ActivityReport query()
 * @method static \Illuminate\Database\Eloquent\Builder|ActivityReport whereContent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ActivityReport whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ActivityReport whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ActivityReport whereProjectId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ActivityReport whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ActivityReport whereUpdatedAt($value)
 */
	class ActivityReport extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\ActivityReportImage
 *
 * @property int $id
 * @property int $activity_report_id
 * @property string $image_url
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\ActivityReport $activityReport
 * @method static \Illuminate\Database\Eloquent\Builder|ActivityReportImage newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ActivityReportImage newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ActivityReportImage query()
 * @method static \Illuminate\Database\Eloquent\Builder|ActivityReportImage whereActivityReportId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ActivityReportImage whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ActivityReportImage whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ActivityReportImage whereImageUrl($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ActivityReportImage whereUpdatedAt($value)
 */
	class ActivityReportImage extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Admin
 *
 * @property int $id
 * @property string $name
 * @property string $email
 * @property \Illuminate\Support\Carbon|null $email_verified_at
 * @property string $password
 * @property string|null $remember_token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @property-read int|null $notifications_count
 * @method static \Illuminate\Database\Eloquent\Builder|Admin newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Admin newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Admin query()
 * @method static \Illuminate\Database\Eloquent\Builder|Admin whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Admin whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Admin whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Admin whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Admin whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Admin wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Admin whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Admin whereUpdatedAt($value)
 */
	class Admin extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Category
 *
 * @property int $id
 * @property string $name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Project $project
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Project[] $projects
 * @property-read int|null $projects_count
 * @method static \Illuminate\Database\Eloquent\Builder|Category getCategories()
 * @method static \Illuminate\Database\Eloquent\Builder|Category newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Category newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Category query()
 * @method static \Illuminate\Database\Eloquent\Builder|Category whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Category whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Category whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Category whereUpdatedAt($value)
 */
	class Category extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Company
 *
 * @property int $id
 * @property string $name
 * @property string $email
 * @property string|null $email_verified_at
 * @property string $password
 * @property string $image_url
 * @property string|null $remember_token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @property-read int|null $notifications_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Talent[] $talents
 * @property-read int|null $talents_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\TemporaryTalent[] $temporaryTalents
 * @property-read int|null $temporary_talents_count
 * @method static \Illuminate\Database\Eloquent\Builder|Company getAllCompanies()
 * @method static \Illuminate\Database\Eloquent\Builder|Company getCompanies()
 * @method static \Illuminate\Database\Eloquent\Builder|Company newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Company newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Company query()
 * @method static \Illuminate\Database\Eloquent\Builder|Company whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Company whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Company whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Company whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Company whereImageUrl($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Company whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Company wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Company whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Company whereUpdatedAt($value)
 */
	class Company extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\FundingModel
 *
 * @property int $id
 * @property string $name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|FundingModel newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|FundingModel newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|FundingModel query()
 * @method static \Illuminate\Database\Eloquent\Builder|FundingModel whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FundingModel whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FundingModel whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FundingModel whereUpdatedAt($value)
 */
	class FundingModel extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Plan
 *
 * @property int $id
 * @property int $project_id
 * @property int $return_type_id
 * @property string $title
 * @property string|null $image_url
 * @property string $content
 * @property int $price
 * @property string|null $place
 * @property string $estimated_return_date
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Project $project
 * @property-read \App\Models\ReturnType $returnType
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\User[] $users
 * @property-read int|null $users_count
 * @method static \Illuminate\Database\Eloquent\Builder|Plan getPlansByCompany($project_id)
 * @method static \Illuminate\Database\Eloquent\Builder|Plan getPlansByTalent($project_id)
 * @method static \Illuminate\Database\Eloquent\Builder|Plan newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Plan newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Plan query()
 * @method static \Illuminate\Database\Eloquent\Builder|Plan whereContent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Plan whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Plan whereEstimatedReturnDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Plan whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Plan whereImageUrl($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Plan wherePlace($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Plan wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Plan whereProjectId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Plan whereReturnTypeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Plan whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Plan whereUpdatedAt($value)
 */
	class Plan extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Project
 *
 * @property int $id
 * @property int $category_id
 * @property int $talent_id
 * @property string $title
 * @property string $explanation
 * @property int $target_amount
 * @property int $funding_model 1->All in 2->All or Nothing
 * @property int $is_released
 * @property \Illuminate\Support\Carbon $start_date
 * @property \Illuminate\Support\Carbon $end_date
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\ActivityReport[] $activityReports
 * @property-read int|null $activity_reports_count
 * @property-read \App\Models\Category $category
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Plan[] $plans
 * @property-read int|null $plans_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\ProjectImage[] $projectImages
 * @property-read int|null $project_images_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\SupporterComment[] $supporterComments
 * @property-read int|null $supporter_comments_count
 * @property-read \App\Models\Talent $talent
 * @method static \Illuminate\Database\Eloquent\Builder|Project getProjects()
 * @method static \Illuminate\Database\Eloquent\Builder|Project getProjectsByCompany()
 * @method static \Illuminate\Database\Eloquent\Builder|Project getProjectsByTalent()
 * @method static \Illuminate\Database\Eloquent\Builder|Project newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Project newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Project query()
 * @method static \Illuminate\Database\Eloquent\Builder|Project whereCategoryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Project whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Project whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Project whereEndDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Project whereExplanation($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Project whereFundingModel($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Project whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Project whereIsReleased($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Project whereStartDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Project whereTalentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Project whereTargetAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Project whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Project whereUpdatedAt($value)
 */
	class Project extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\ProjectImage
 *
 * @property int $id
 * @property int $project_id
 * @property string $image_url
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Project $project
 * @method static \Illuminate\Database\Eloquent\Builder|ProjectImage newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ProjectImage newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ProjectImage query()
 * @method static \Illuminate\Database\Eloquent\Builder|ProjectImage whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProjectImage whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProjectImage whereImageUrl($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProjectImage whereProjectId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProjectImage whereUpdatedAt($value)
 */
	class ProjectImage extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\RepliesToSupporterComment
 *
 * @property int $id
 * @property int $supporter_comment_id
 * @property int $talent_id
 * @property string $content
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\SupporterComment $supporterComment
 * @property-read \App\Models\Talent $talent
 * @method static \Illuminate\Database\Eloquent\Builder|RepliesToSupporterComment newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|RepliesToSupporterComment newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|RepliesToSupporterComment query()
 * @method static \Illuminate\Database\Eloquent\Builder|RepliesToSupporterComment whereContent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RepliesToSupporterComment whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RepliesToSupporterComment whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RepliesToSupporterComment whereSupporterCommentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RepliesToSupporterComment whereTalentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RepliesToSupporterComment whereUpdatedAt($value)
 */
	class RepliesToSupporterComment extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\ReturnType
 *
 * @property int $id
 * @property string $name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Plan[] $plans
 * @property-read int|null $plans_count
 * @method static \Illuminate\Database\Eloquent\Builder|ReturnType newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ReturnType newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ReturnType query()
 * @method static \Illuminate\Database\Eloquent\Builder|ReturnType whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ReturnType whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ReturnType whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ReturnType whereUpdatedAt($value)
 */
	class ReturnType extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\SnsUser
 *
 * @property int $id
 * @property int $user_id
 * @property string $sns_user_id
 * @property string $sns_name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|SnsUser newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|SnsUser newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|SnsUser query()
 * @method static \Illuminate\Database\Eloquent\Builder|SnsUser whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SnsUser whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SnsUser whereSnsName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SnsUser whereSnsUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SnsUser whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SnsUser whereUserId($value)
 */
	class SnsUser extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\SupporterComment
 *
 * @property int $id
 * @property int $project_id
 * @property int $user_id
 * @property string $content
 * @property string|null $image_url
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\User[] $likedUsers
 * @property-read int|null $liked_users_count
 * @property-read \App\Models\Project $project
 * @property-read \App\Models\RepliesToSupporterComment|null $repliesToSupporterComment
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Talent[] $talent
 * @property-read int|null $talent_count
 * @property-read \App\Models\User $user
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\UserSupporterCommentLiked[] $userSupporterCommentLiked
 * @property-read int|null $user_supporter_comment_liked_count
 * @method static \Illuminate\Database\Eloquent\Builder|SupporterComment getSupporterCommentsByTalent()
 * @method static \Illuminate\Database\Eloquent\Builder|SupporterComment newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|SupporterComment newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|SupporterComment query()
 * @method static \Illuminate\Database\Eloquent\Builder|SupporterComment whereContent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SupporterComment whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SupporterComment whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SupporterComment whereImageUrl($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SupporterComment whereProjectId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SupporterComment whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SupporterComment whereUserId($value)
 */
	class SupporterComment extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Talent
 *
 * @property int $id
 * @property int $company_id
 * @property string $name
 * @property string $email
 * @property string|null $email_verified_at
 * @property string $password
 * @property string $image_url
 * @property string|null $remember_token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @property-read int|null $notifications_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\SupporterComment[] $supporterComment
 * @property-read int|null $supporter_comment_count
 * @method static \Illuminate\Database\Eloquent\Builder|Talent getTalents()
 * @method static \Illuminate\Database\Eloquent\Builder|Talent getTalentsByCompany()
 * @method static \Illuminate\Database\Eloquent\Builder|Talent newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Talent newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Talent query()
 * @method static \Illuminate\Database\Eloquent\Builder|Talent whereCompanyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Talent whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Talent whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Talent whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Talent whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Talent whereImageUrl($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Talent whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Talent wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Talent whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Talent whereUpdatedAt($value)
 */
	class Talent extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\TemporaryCompany
 *
 * @property int $id
 * @property string $name
 * @property string $email
 * @property string|null $email_verified_at
 * @property string $password
 * @property string|null $image_url
 * @property string|null $remember_token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|TemporaryCompany getTemporaryCompanies()
 * @method static \Illuminate\Database\Eloquent\Builder|TemporaryCompany newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|TemporaryCompany newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|TemporaryCompany query()
 * @method static \Illuminate\Database\Eloquent\Builder|TemporaryCompany whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TemporaryCompany whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TemporaryCompany whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TemporaryCompany whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TemporaryCompany whereImageUrl($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TemporaryCompany whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TemporaryCompany wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TemporaryCompany whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TemporaryCompany whereUpdatedAt($value)
 */
	class TemporaryCompany extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\TemporaryTalent
 *
 * @property int $id
 * @property int $company_id
 * @property string $name
 * @property string $email
 * @property string|null $email_verified_at
 * @property string $password
 * @property string $image_url
 * @property string|null $remember_token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Company $company
 * @method static \Illuminate\Database\Eloquent\Builder|TemporaryTalent getTemporaryTalents()
 * @method static \Illuminate\Database\Eloquent\Builder|TemporaryTalent getTemporaryTalentsForCompany(int $company_id)
 * @method static \Illuminate\Database\Eloquent\Builder|TemporaryTalent newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|TemporaryTalent newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|TemporaryTalent query()
 * @method static \Illuminate\Database\Eloquent\Builder|TemporaryTalent whereCompanyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TemporaryTalent whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TemporaryTalent whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TemporaryTalent whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TemporaryTalent whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TemporaryTalent whereImageUrl($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TemporaryTalent whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TemporaryTalent wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TemporaryTalent whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TemporaryTalent whereUpdatedAt($value)
 */
	class TemporaryTalent extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\User
 *
 * @property int $id
 * @property string $name
 * @property string $email
 * @property \Illuminate\Support\Carbon|null $email_verified_at
 * @property string $password
 * @property string|null $two_factor_secret
 * @property string|null $two_factor_recovery_codes
 * @property string|null $remember_token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @property-read int|null $notifications_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Plan[] $plans
 * @property-read int|null $plans_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\SupporterComment[] $supportComments
 * @property-read int|null $support_comments_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\SupporterComment[] $userSupporterCommentLiked
 * @property-read int|null $user_supporter_comment_liked_count
 * @method static \Illuminate\Database\Eloquent\Builder|User getUsers()
 * @method static \Illuminate\Database\Eloquent\Builder|User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User query()
 * @method static \Illuminate\Database\Eloquent\Builder|User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereTwoFactorRecoveryCodes($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereTwoFactorSecret($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereUpdatedAt($value)
 */
	class User extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\UserPlanCheering
 *
 * @property int $id
 * @property int $user_id
 * @property int $plan_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Plan $plan
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|UserPlanCheering newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|UserPlanCheering newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|UserPlanCheering query()
 * @method static \Illuminate\Database\Eloquent\Builder|UserPlanCheering whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserPlanCheering whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserPlanCheering wherePlanId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserPlanCheering whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserPlanCheering whereUserId($value)
 */
	class UserPlanCheering extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\UserSupporterCommentLiked
 *
 * @property int $id
 * @property int $supporter_comment_id
 * @property int $user_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|UserSupporterCommentLiked newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|UserSupporterCommentLiked newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|UserSupporterCommentLiked query()
 * @method static \Illuminate\Database\Eloquent\Builder|UserSupporterCommentLiked whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserSupporterCommentLiked whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserSupporterCommentLiked whereSupporterCommentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserSupporterCommentLiked whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserSupporterCommentLiked whereUserId($value)
 */
	class UserSupporterCommentLiked extends \Eloquent {}
}

