<?php

use App\Http\Controllers\Admin\ReportController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\CompanyController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\DetailController;
use App\Http\Controllers\Admin\LoginController;
use App\Http\Controllers\Admin\MailController;
use App\Http\Controllers\Admin\MessageController;
use App\Http\Controllers\Admin\PlanController;
use App\Http\Controllers\Admin\ProjectController;
use App\Http\Controllers\Admin\RepliesToSupporterCommentController;
use App\Http\Controllers\Admin\SupporterCommentController;
use App\Http\Controllers\Admin\TalentController;
use App\Http\Controllers\Admin\TemporaryCompanyController;
use App\Http\Controllers\Admin\TemporaryTalentController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\WorkAttendanceController;
use App\Http\Controllers\Admin\WorkShiftController;
use App\Http\Controllers\Admin\SupporterPurchaseController;
use Illuminate\Support\Facades\Route;

//ログイン
Route::middleware(['guest:admin', 'throttle:5'])->group(function () {
    Route::get('login', [LoginController::class, 'create'])->name('login');
    Route::post('login', [LoginController::class, 'store']);
    //---------------------OAuth-----------------------------------------------
    Route::prefix('login/{provider}')->where(['provider' => '(line|twitter|facebook|google|yahoo)'])->group(function () {
        Route::get('/', [LoginController::class, 'redirectToProvider'])->name('sns_login.redirect');
        Route::get('/callback', [LoginController::class, 'handleProviderCallback'])->name('sns_login.callback');
    });
});

//管理画面のルート
Route::middleware('auth:admin')->group(function () {
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');

    //ユーザー管理
    Route::resource('user', UserController::class)->only(['index', 'create', 'store', 'edit', 'update', 'destroy']);
    Route::get('user/search', [UserController::class, 'search'])->name('user.search');
    Route::get('user/password_reset/{user}', [UserController::class, 'passwordReset'])->name('user.password_reset');

    //企業管理
    Route::resource('company', CompanyController::class)->only(['index', 'create', 'store', 'edit', 'update', 'destroy']);
    Route::get('company/{company}/release/{is_released}', [CompanyController::class, 'release'])->name('company.release');
    Route::get('company/search', [CompanyController::class, 'search'])->name('company.search');
    Route::get('temporary_company/search', [TemporaryCompanyController::class, 'search'])->name('temporary_company.search');
    Route::resource('temporary_company', TemporaryCompanyController::class, ['only' => ['index', 'show']]);
    Route::post('temporary_company/{temporary_company}/accept', [TemporaryCompanyController::class, 'accept'])->name('temporary_company.accept');
    Route::delete('temporary_company/{temporary_company}/delete', [TemporaryCompanyController::class, 'reject'])->name('temporary_company.reject');
    Route::get('company/password_reset/{company}', [CompanyController::class, 'passwordReset'])->name('company.password_reset');
    Route::post('remarks/update/{company}', [CompanyController::class, 'updateRemarks'])->name('remarks.update');

    //タレント管理
    Route::resource('talent', TalentController::class, ['only' => ['index', 'create', 'store', 'edit', 'update', 'destroy']]);
    Route::get('talent/{talent}/release/{is_released}', [TalentController::class, 'release'])->name('talent.release');
    Route::get('talent/search', [TalentController::class, 'search'])->name('talent.search');
    Route::resource('temporary_talent', TemporaryTalentController::class, ['only' => ['index', 'show']]);
    Route::post('temporary_talent/{temporary_talent}/accept', [TemporaryTalentController::class, 'accept'])->name('temporary_talent.accept');
    Route::delete('temporary_talent/{temporary_talent}/delete', [TemporaryTalentController::class, 'reject'])->name('temporary_talent.reject');
    Route::post('temporary_talent/search', [TemporaryTalentController::class, 'search'])->name('temporary_talent.search');
    Route::get('talent/password_reset/{talent}', [TalentController::class, 'passwordReset'])->name('talent.password_reset');

    //カテゴリー管理
    Route::resource('category', CategoryController::class, ['only' => ['index', 'create', 'store', 'edit', 'update', 'destroy']]);

    //プロフィール管理
    Route::resource('detail', DetailController::class, ['only' => ['show', 'edit', 'update']]);

    // プラン管理
    Route::get('plan/search', [PlanController::class, 'search'])->name('plan.search');
    Route::resource('plan', PlanController::class, ['only' => ['index', 'show', 'destroy']]);

    // 活動報告管理
    Route::get('report/search', [ReportController::class, 'search'])->name('report.search');
    Route::resource('report', ReportController::class, ['only' => ['index', 'show', 'destroy']]);

    //プロジェクト管理
    Route::get('project/search', [ProjectController::class, 'search'])->name('project.search');
    Route::resource('project', ProjectController::class, ['only' => ['index', 'create', 'store', 'edit', 'update', 'destroy', 'show']]);
    Route::get('project/{project}/release', [ProjectController::class, 'release'])->name('project.release');
    Route::get('project/{project}/preview', [ProjectController::class, 'preview'])->name('project.preview');
    Route::get('project/{project}/output_cheering_users_to_csv', [ProjectController::class, 'output_cheering_users_to_csv'])->name('project.output_cheering_users_to_csv');
    Route::delete('project/image/{project_image}', [ProjectController::class, 'deleteImage'])->name('project.image');
    Route::patch('project/{project}/increment_likes', [ProjectController::class, 'incrementLikes'])->name('project.increment_likes');
    Route::patch('project/{project}/decrement_likes', [ProjectController::class, 'decrementLikes'])->name('project.decrement_likes');
    Route::prefix('project/{project}')->group(function () {
        Route::resource('plan', PlanController::class, ['only' => ['create', 'store', 'edit', 'update']]);
        Route::get('plan/{plan}/preview', [PlanController::class, 'preview'])->name('plan.preview');
        Route::get('send_back', [ProjectController::class, 'sendBack'])->name('project.send_back');
        Route::get('approved', [ProjectController::class, 'approved'])->name('project.approved');
        Route::get('under_suspension', [ProjectController::class, 'underSuspension'])->name('project.under_suspension');

        Route::resource('report', ReportController::class, ['only' => ['create', 'store', 'edit', 'update', 'destroy']]);
    });
    Route::delete('plan/image/{plan}', [PlanController::class, 'deleteImage'])->name('plan_image.destroy');
    Route::delete('plan/option/{option}', [PlanController::class, 'deleteOption'])->name('option.destroy');
    Route::delete('activity_report/image/{activity_report_image}', [ReportController::class, 'deleteImage'])->name('activity_report.image');

    // 支援者コメント管理
    Route::get('supporter_comment/search', [SupporterCommentController::class, 'search'])->name('supporter_comment.search');
    Route::resource('supporter_comment', SupporterCommentController::class, ['only' => ['index', 'edit', 'update', 'destroy']]);
    Route::prefix('supporter_comment/{supporter_comment}')->group(function () {
        Route::get('replies_to_supporter_comment/create', [RepliesToSupporterCommentController::class, 'create'])->name('replies_to_supporter_comment.create');
        Route::post('replies_to_supporter_comment', [RepliesToSupporterCommentController::class, 'store'])->name('replies_to_supporter_comment.store');
    });
    Route::resource('replies_to_supporter_comment', RepliesToSupporterCommentController::class, ['only' => ['edit', 'update', 'destroy']]);
    Route::get('project/{project}/create_cheering_users_mail', [MailController::class, 'createCheeringUsersMail'])->name('project.mail.create_cheering_users_mail');
    Route::post('project/preview_cheering_users_mail', [MailController::class, 'previewCheeringUsersMail'])->name('project.mail.preview_cheering_users_mail');
    Route::post('project/send_cheering_users_mail', [MailController::class, 'sendCheeringUsersMail'])->name('project.mail.send_cheering_users_mail');
    Route::delete('supporter_comment/image/{supporter_comment}', [SupporterCommentController::class, 'deleteImage'])->name('supporter_comment.image');

    // メッセージ管理
    // Route::get('message/search', [MessageController::class, 'search'])->name('message.search');
    Route::resource('message', MessageController::class)->only(['index','show']);
    Route::post('message/{user_plan_cheering}', [MessageController::class,'store'])->name('message_content.store');
    Route::put('message/{message_content}', [MessageController::class,'update'])->name('message_content.update');
    Route::delete('message/{message_content}', [MessageController::class,'destroy'])->name('message_content.destroy');
    Route::get('message/{message_content}/file_download', [MessageController::class,'file_download'])->name('message_content.file_download');

    // 勤怠管理
    Route::get('work_shift/{talent}', [WorkShiftController::class,'edit'])->name('work_shift.edit');
    Route::put('work_shift/update/{talent}', [WorkShiftController::class,'update'])->name('work_shift.update');

    //実績管理
    Route::get('work_attendance/{talent}', [WorkAttendanceController::class,'edit'])->name('work_attendance.edit');
    Route::put('work_attendance/update/{talent}', [WorkAttendanceController::class,'update'])->name('work_attendance.update');

    Route::resource('supporter_purchase', SupporterPurchaseController::class, ['only' => ['index']]);
    Route::get('supporter_purchase/search', [SupporterPurchaseController::class, 'search'])->name('supporter_purchase.search');
});

// 上記以外のパラメーターを取得して、route('admin.dashboard')にリダイレクトする。
Route::get('/{any?}', function () {
    return redirect()->route('admin.dashboard');
})->where('any', '.+');
