<?php

use App\Http\Controllers\User\LoginController;
use App\Http\Controllers\User\MessageController;
use App\Http\Controllers\User\PlanController;
use App\Http\Controllers\User\ProjectController;
use App\Http\Controllers\User\CommentController;
use App\Http\Controllers\User\ReplyController;
use App\Http\Controllers\User\ReportController;
use App\Http\Controllers\User\PasswordResetController;
use App\Http\Controllers\User\InquiryController;
use App\Http\Controllers\User\MypageController;
use App\Http\Controllers\User\MyProjectController;
use App\Http\Controllers\User\MyPlanController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User\RegisterController;

//---------------------projects-----------------------------------------------
Route::get('/', [ProjectController::class, 'index'])->name('index');
Route::get('/search', [ProjectController::class, 'search'])->name('search');
Route::post('/project/{project}/liked', [ProjectController::class, 'ProjectLiked'])->name('user.project.liked');
Route::resource('project', ProjectController::class)->only('show')->middleware('project.released');

Route::prefix('project/{project}')->middleware('auth', 'project.released')->group(function () {
    Route::get('plan/selectPlans/{plan?}', [ProjectController::class, 'selectPlans'])->name('plan.selectPlans')->middleware('CheckProjectIsPublished');
    Route::post('plan/confirmPayment', [ProjectController::class, 'confirmPayment'])->name('plan.confirmPayment');
    Route::get('plan/prepare_for_payment', [ProjectController::class, 'prepareForPayment'])->name('plan.prepare_for_payment');
    Route::get('plan/{payment}/paymentForPayJp', [ProjectController::class, 'paymentForPayJp'])->name('plan.paymentForPayJp');
    Route::get('plan/{payment}/payment_for_pay_pay', [ProjectController::class, 'paymentForPayPay'])->name('plan.payment_for_pay_pay');
    Route::get('plan/{plan}', [PlanController::class, 'show'])->name('plan.show');
    Route::post('comment', [CommentController::class, 'store'])->name('comment.store')->middleware('project.released');
    Route::get('support', [ProjectController::class, 'support'])->name('project.support');
    Route::get('supporter_ranking', [ProjectController::class, 'supporterRanking'])->name('project.supporter_ranking');
});

//---------------------Mypage-----------------------------------------------
Route::group(['middleware' => ['auth:web']], function () {
    Route::prefix('my_project')->group(function () {
        Route::post('project/upload_editor_file', [MyProjectController::class, 'uploadEditorFile'])->name('project.upload_editor_file');
        Route::post('uploadProject/{project}', [MyProjectController::class, 'uploadProject']);
        Route::post('project/{project}/uploadProjectImage/{project_file?}', [MyProjectController::class, 'uploadProjectImage'])->name('project.uploadProjectImage');
        Route::post('project/{project}/uploadIdentifyImage/{identification}', [MyProjectController::class, 'uploadIdentifyImage'])->name('uploadIdentifyImage');
        Route::post('project/{project}/apply', [MyProjectController::class, 'apply'])->name('project.apply');
        Route::get('project/{project}/create_plan', [MyProjectController::class, 'createPlan'])->name('project.create_plan');
        Route::prefix('project/{project}')->group(function () {
            Route::get('createReturn', [MyPlanController::class, 'createReturn']);
            Route::post('updatePlan/{plan}', [MyPlanController::class, 'updateReturn']);
            Route::delete('delete_plan/{plan}', [MyPlanController::class, 'deletePlan']);
            Route::resource('plan', MyPlanController::class)->only(['store', 'update']);
            Route::resource('comment', CommentController::class)->only(['index', 'destroy']);
            Route::resource('report', ReportController::class)->only(['index', 'create', 'store', 'edit', 'update']);
            Route::post('reply/{comment}', [ReplyController::class, 'store'])->name('reply.store');
            Route::resource('reply', ReplyController::class)->only(['destroy']);
        });
        Route::name('my_project.')->group(function () {
            Route::resource('project', MyProjectController::class)->only(['index', 'create', 'store', 'show', 'edit', 'update', 'destroy']);
            Route::get('reward_sample', [MyProjectController::class, 'rewardSample'])->name('reward_sample');
        });
        Route::delete('project/file/{project_file}', [MyProjectController::class, 'deleteFile'])->name('project_image.destroy');
        // Route::delete('project/file/{project_file}', [ProjectController::class, 'deleteFile'])->name('project.delete.file');
        Route::get('{project}/message/{selected_message?}', [MessageController::class, 'indexByExecutor'])->name('my_project.message.index');
        Route::get('message/{payment}', [MessageController::class, 'showByExecutor'])->name('my_project.message.show');
        Route::post('message/{payment}', [MessageController::class, 'storeByExecutor'])->name('my_project.message_content.store');
        Route::get('message/{message_content}/file_download', [MessageController::class, 'fileDownloadByExecutor'])->name('my_project.message_content.file_download');
    });
    Route::get('my_project/{project}/edit_my_project', [MyProjectController::class, 'editMyProject'])->name('my_project.target_amount');
    Route::get('/payment_history', [MypageController::class, 'paymentHistory'])->name('payment_history');
    Route::get('/contribution_comments', [MypageController::class, 'contributionComments'])->name('contribution_comments');
    Route::get('/purchased_projects', [MypageController::class, 'purchasedProjects'])->name('purchased_projects');
    Route::get('/liked_projects', [MypageController::class, 'likedProjects'])->name('liked_projects');
    Route::get('/profile', [MypageController::class, 'profile'])->name('profile');
    Route::patch('/profile/{user}', [MypageController::class, 'updateProfile'])->name('update_profile');
    Route::get('/withdraw', [MypageController::class, 'withdraw'])->name('withdraw');
    Route::delete('/withdraw/{user}', [MypageController::class, 'delete_user'])->name('delete_user');

    //---------------------Project掲載依頼-----------------------------------------------
    Route::get('/consult_project', [ProjectController::class, 'consultProject'])->name('consult_project');
    Route::post('/consult_project', [ProjectController::class, 'consultProjectSend'])->name('consult_project.send');

    //---------------------メッセージ一覧-----------------------------------------------
    Route::get('message/{selected_message?}', [MessageController::class, 'index'])->name('message.index');
    Route::get('message/{payment}', [MessageController::class, 'show'])->name('message.show');
    Route::post('message/{payment}', [MessageController::class, 'store'])->name('message_content.store');
    Route::get('message/{message_content}/file_download', [MessageController::class, 'fileDownload'])->name('message_content.file_download');
});

Route::middleware(['guest:web', 'throttle:10'])->group(function () {
    Route::get('pre_create', [RegisterController::class, 'preCreate'])->name('pre_create');
    Route::post('pre_register', [RegisterController::class, 'preRegister'])->name('pre_register');
    Route::get('/create/{token}', [RegisterController::class, 'create'])->name('create');
    Route::post('/register/{token}', [RegisterController::class, 'store'])->name('register');
    //---------------------OAuth-----------------------------------------------
    Route::prefix('login/{provider}')->where(['provider' => '(line|twitter|facebook|google|yahoo)'])->group(function () {
        Route::get('/', [LoginController::class, 'redirectToProvider'])->name('sns_login.redirect');
        Route::get('/callback', [LoginController::class, 'handleProviderCallback'])->name('sns_login.callback');
    });
});
// --------------------Top Page-------------------
Route::get('/question', [MypageController::class, 'question'])->name('question');

//---------------------Forgot Password-----------------------------------------------
Route::get('/forgot_password', [PasswordResetController::class, 'forgotPassword'])->name('forgot_password');
Route::post('/send_reset_password_mail', [PasswordResetController::class, 'sendResetPasswordMail'])->name('send_reset_password_mail');
// --------------------password reset-------------------
Route::get('/password_reset/{token}', [PasswordResetController::class, 'reset'])->name('password.reset');
Route::post('/password_reset', [PasswordResetController::class, 'update'])->name('password.update');

// --------------------inqury-------------------
Route::get('/inquiry/create', [InquiryController::class, 'createInquiry'])->name('inquiry.create');
Route::post('/inquiry/send', [InquiryController::class, 'sendInquiry'])->name('inquiry.send');

// --------------------terms of service-------------------
Route::get('/terms_of_service', [MypageController::class, 'termsOfService'])->name('terms_of_service');
// --------------------PS terms of service-------------------
Route::get('/ps_terms_of_service', [MypageController::class, 'PsTermsOfService'])->name('ps_terms_of_service');
// --------------------privacy policy-------------------
Route::get('/privacy_policy', [MypageController::class, 'privacyPolicy'])->name('privacy_policy');
// --------------------trade law-------------------
Route::get('/trade_law', [MypageController::class, 'tradeLaw'])->name('trade_law');

// --------------------commission-------------------
Route::get('commission', [MypageController::class, 'commission'])->name('commission');
