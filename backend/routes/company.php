<?php

use App\Http\Controllers\Company\ActivityReportController;
use App\Http\Controllers\Company\DashboardController;
use App\Http\Controllers\Company\DetailController;
use App\Http\Controllers\Company\LoginController;
use App\Http\Controllers\Company\MailController;
use App\Http\Controllers\Company\MessageController;
use App\Http\Controllers\Company\PlanController;
use App\Http\Controllers\Company\ProjectController;
use App\Http\Controllers\Company\RegisterController;
use App\Http\Controllers\Company\RepliesToSupporterCommentController;
use App\Http\Controllers\Company\SupporterCommentController;
use App\Http\Controllers\Company\TalentController;
use App\Http\Controllers\Company\TemporaryTalentController;
use App\Http\Controllers\Company\WorkAttendanceController;
use App\Http\Controllers\Company\WorkShiftController;
use App\Http\Controllers\Company\PasswordResetController;
use Illuminate\Support\Facades\Route;

/*ログイン用ルーティング*/
Route::middleware(['guest:company'])->group(function () {
    Route::get('login', [LoginController::class, 'create'])->name('login');
    Route::post('login', [LoginController::class, 'store']);
    Route::get('password_reset/{token}', [PasswordResetController::class, 'reset'])->name('password.reset');
    Route::post('password_reset', [PasswordResetController::class, 'update'])->name('password.update');
    //---------------------OAuth-----------------------------------------------
    Route::prefix('login/{provider}')->where(['provider' => '(line|twitter|facebook|google|yahoo)'])->group(function () {
        Route::get('/', [LoginController::class, 'redirectToProvider'])->name('sns_login.redirect');
        Route::get('/callback', [LoginController::class, 'handleProviderCallback'])->name('sns_login.callback');
    });
});

/*登録用ルーティング*/
Route::middleware(['guest:company'])->group(function () {
    Route::get('pre_create', [RegisterController::class, 'preCreate'])->name('pre_create');
    Route::post('pre_register', [RegisterController::class, 'preRegister'])->name('pre_register');
    Route::get('/create/{token}', [RegisterController::class, 'create'])->name('create');
    Route::post('/register/{token}', [RegisterController::class, 'store'])->name('register');
    Route::get('register_finished', [RegisterController::class, 'registerFinished'])->name('register_finished');
});

/*ログイン後管理画面のルーティング*/
Route::middleware('auth:company', 'company.own')->group(function () {
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // 各種設定
    Route::resource('detail', DetailController::class, ['only' => ['show', 'edit', 'update']]);

    /*タレント管理*/
    Route::resource('talent', TalentController::class)->except(['show']);
    Route::post('talent/search', [TalentController::class, 'search'])->name('talent.search');
    Route::resource('temporary_talent', TemporaryTalentController::class, ['only' => ['index', 'show']]);
    Route::post('temporary_talent/{temporary_talent}/accept', [TemporaryTalentController::class, 'accept'])->name('temporary_talent.accept');
    Route::delete('temporary_talent/{temporary_talent}/delete', [TemporaryTalentController::class, 'reject'])->name('temporary_talent.reject');
    Route::post('temporary_talent/search', [TemporaryTalentController::class, 'search'])->name('temporary_talent.search');

    /*プラン管理*/
    Route::get('plan/search', [PlanController::class, 'search'])->name('plan.search');
    Route::resource('plan', PlanController::class, ['only' => ['index', 'show', 'destroy']]);

    // 活動報告管理
    Route::get('activity_report/search', [ActivityReportController::class, 'search'])->name('activity_report.search');
    Route::resource('activity_report', ActivityReportController::class, ['only' => ['index', 'show']]);

    /*プロジェクト管理*/
    Route::get('project/search', [ProjectController::class, 'search'])->name('project.search');
    Route::resource('project', ProjectController::class);
    Route::get('project/{project}/preview', [ProjectController::class, 'preview'])->name('project.preview');
    Route::delete('project/image/{project_image}', [ProjectController::class, 'deleteImage'])->name('project.image');
    Route::prefix('project/{project}')->group(function () {
        Route::get('approval_request', [ProjectController::class, 'approvalRequest'])->name('project.approval_request');
        Route::resource('plan', PlanController::class, ['only' => ['create', 'store', 'edit', 'update']]);
        Route::get('plan/{plan}/preview', [PlanController::class, 'preview'])->name('plan.preview');
        Route::resource('activity_report', ActivityReportController::class, ['only' => ['create', 'store', 'edit', 'update', 'destroy']]);
    });
    Route::delete('plan/image/{plan}', [PlanController::class, 'deleteImage'])->name('plan_image.destroy');
    Route::delete('plan/option/{option}', [PlanController::class, 'deleteOption'])->name('option.destroy');
    Route::delete('activity_report/image/{activity_report_image}', [ActivityReportController::class, 'deleteImage'])->name('activity_report.image');
    Route::delete('supporter_comment/image/{supporter_comment}', [SupporterCommentController::class, 'deleteImage'])->name('supporter_comment.image');

    Route::get('supporter_comment/search', [SupporterCommentController::class, 'search'])->name('supporter_comment.search');
    Route::resource('supporter_comment', SupporterCommentController::class, ['only' => ['index', 'edit', 'update', 'destroy']]);
    Route::get('supporter_comment/search', [SupporterCommentController::class, 'search'])->name('supporter_comment.search');
    Route::prefix('supporter_comment/{supporter_comment}')->group(function () {
        Route::get('replies_to_supporter_comment/create', [RepliesToSupporterCommentController::class, 'create'])->name('replies_to_supporter_comment.create');
        Route::post('replies_to_supporter_comment', [RepliesToSupporterCommentController::class, 'store'])->name('replies_to_supporter_comment.store');
    });
    Route::resource('replies_to_supporter_comment', RepliesToSupporterCommentController::class, ['only' => ['edit', 'update', 'destroy']]);
    Route::get('project/{project}/create_cheering_users_mail', [MailController::class, 'createCheeringUsersMail'])->name('project.mail.create_cheering_users_mail');
    Route::post('project/preview_cheering_users_mail', [MailController::class, 'previewCheeringUsersMail'])->name('project.mail.preview_cheering_users_mail');
    Route::post('project/send_cheering_users_mail', [MailController::class, 'sendCheeringUsersMail'])->name('project.mail.send_cheering_users_mail');

    // メッセージ管理
    // Route::get('message/search', [MessageController::class, 'search'])->name('message.search');
    Route::resource('message', MessageController::class)->only(['index','show']);
    Route::post('message/{user_plan_cheering}', [MessageController::class,'store'])->name('message_content.store');
    Route::get('message/{message_content}/file_download', [MessageController::class,'file_download'])->name('message_content.file_download');

    // 勤怠管理
    Route::get('work_shift/{talent}', [WorkShiftController::class,'edit'])->name('work_shift.edit');
    Route::put('work_shift/update/{talent}', [WorkShiftController::class,'update'])->name('work_shift.update');

    //実績管理
    Route::get('work_attendance/{talent}', [WorkAttendanceController::class,'edit'])->name('work_attendance.edit');
    Route::put('work_attendance/update/{talent}', [WorkAttendanceController::class,'update'])->name('work_attendance.update');
});

// 上記以外のパラメーターを取得して、route('admin.dashboard')にリダイレクトする。
Route::get('/{any?}', function () {
    return redirect()->route('company.dashboard');
})->where('any', '.+');
