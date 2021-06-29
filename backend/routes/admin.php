<?php

use App\Http\Controllers\Admin\ActivityReportController;
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
    Route::get('user/password_reset/{user}', [UserController::class, 'passwordReset'])->name('user.password_reset');

    //プロフィール管理
    Route::resource('detail', DetailController::class, ['only' => ['show', 'edit', 'update']]);

    //プロジェクト管理
    Route::resource('project', ProjectController::class, ['only' => ['index', 'create', 'store', 'edit', 'update', 'destroy', 'show']]);
    Route::get('project/{project}/release', [ProjectController::class, 'release'])->name('project.release');
    Route::get('project/{project}/preview', [ProjectController::class, 'preview'])->name('project.preview');
    Route::get('project/{project}/output_cheering_users_to_csv', [ProjectController::class, 'output_cheering_users_to_csv'])->name('project.output_cheering_users_to_csv');
    Route::delete('project/image/{project_image}', [ProjectController::class, 'deleteImage'])->name('project.image');
    // Route::patch('project/{project}/increment_likes', [ProjectController::class, 'incrementLikes'])->name('project.increment_likes');
    // Route::patch('project/{project}/decrement_likes', [ProjectController::class, 'decrementLikes'])->name('project.decrement_likes');
    Route::prefix('project/{project}')->group(function () {
        Route::resource('plan', PlanController::class, ['only' => ['create', 'store']]);
        Route::get('send_back', [ProjectController::class, 'sendBack'])->name('project.send_back');
        Route::get('approved', [ProjectController::class, 'approved'])->name('project.approved');
        Route::get('under_suspension', [ProjectController::class, 'underSuspension'])->name('project.under_suspension');
        Route::resource('activity_report', ActivityReportController::class, ['only' => ['create', 'store', 'edit', 'update', 'destroy']]);
    });
    Route::get('project/{project}/create_cheering_users_mail', [MailController::class, 'createCheeringUsersMail'])->name('project.mail.create_cheering_users_mail');
    Route::post('project/preview_cheering_users_mail', [MailController::class, 'previewCheeringUsersMail'])->name('project.mail.preview_cheering_users_mail');
    Route::post('project/send_cheering_users_mail', [MailController::class, 'sendCheeringUsersMail'])->name('project.mail.send_cheering_users_mail');
    Route::delete('plan/image/{plan}', [PlanController::class, 'deleteImage'])->name('plan_image.destroy');
    Route::delete('plan/option/{option}', [PlanController::class, 'deleteOption'])->name('option.destroy');
    Route::delete('activity_report/image/{activity_report_image}', [ActivityReportController::class, 'deleteImage'])->name('activity_report.image');

    // プラン管理
    Route::resource('plan', PlanController::class, ['only' => ['index', 'edit','update', 'show', 'destroy']]);
    Route::get('plan/{plan}/preview', [PlanController::class, 'preview'])->name('plan.preview');

    // 応募者管理
    Route::resource('user_payment_included', ActivityReportController::class, ['only' => ['index', 'show', 'destroy']]);

    // 活動報告管理
    Route::resource('report', ActivityReportController::class, ['only' => ['index', 'show', 'destroy']]);

    // コメント管理
    Route::resource('comment', ActivityReportController::class, ['only' => ['index', 'show', 'destroy']]);

    //返信管理
    Route::resource('reply_to_comment', ActivityReportController::class, ['only' => ['index', 'show', 'destroy']]);

    // メッセージ管理
    Route::resource('message', MessageController::class)->only(['index','show']);
    Route::post('message/{user_plan_cheering}', [MessageController::class,'store'])->name('message_content.store');
    Route::put('message/{message_content}', [MessageController::class,'update'])->name('message_content.update');
    Route::delete('message/{message_content}', [MessageController::class,'destroy'])->name('message_content.destroy');
    Route::get('message/{message_content}/file_download', [MessageController::class,'file_download'])->name('message_content.file_download');

    Route::resource('supporter_purchase', SupporterPurchaseController::class, ['only' => ['index']]);
});

// 上記以外のパラメーターを取得して、route('admin.dashboard')にリダイレクトする。
Route::get('/{any?}', function () {
    return redirect()->route('admin.dashboard');
})->where('any', '.+');
