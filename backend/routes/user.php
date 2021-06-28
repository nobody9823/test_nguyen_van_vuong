<?php

use App\Http\Controllers\User\LoginController;
use App\Http\Controllers\User\MessageController;
use App\Http\Controllers\User\PlanController;
use App\Http\Controllers\User\ProjectController;
use App\Http\Controllers\User\CommentController;
use App\Http\Controllers\User\TopPageController;
use App\Http\Controllers\User\PasswordResetController;
use App\Http\Controllers\User\InquiryController;
use App\Http\Controllers\User\MypageController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User\RegisterController;

//---------------------projects-----------------------------------------------
Route::get('/', [ProjectController::class, 'index'])->name('index');
Route::get('/search', [ProjectController::class, 'search'])->name('search');
Route::post('/project/{project}/liked', [ProjectController::class, 'ProjectLiked'])->name('user.project.liked');
Route::resource('project', ProjectController::class)->only('show')->middleware('project.released');

Route::prefix('project/{project}')->middleware('auth', 'project.released')->group(function () {
    Route::get('plan/selectPlans', [ProjectController::class, 'selectPlans'])->name('plan.selectPlans');
    Route::get('plan/confirmPayment', [ProjectController::class, 'confirmPayment'])->name('plan.confirmPayment');
    Route::get('plan/{plan}', [PlanController::class, 'show'])->name('plan.show');
    Route::get('plan/{plan}/address', [PlanController::class, 'address'])->name('plan.address');
    Route::post('plan/{plan}/address', [PlanController::class, 'addressConfirm'])->name('plan.address.confirm');
    Route::get('plan/{plan}/select_payment', [PlanController::class, 'selectPayment'])->name('plan.select_payment');
    Route::get('plan/{plan}/join_for_payjp/{unique_token}', [PlanController::class, 'joinPlanForPayJp'])->name('plan.join_for_payjp');
    Route::get('plan/{plan}/join_for_paypay/{unique_token}', [PlanController::class, 'joinPlanForPayPay'])->name('plan.join_for_paypay');
    Route::get('plan/{plan}/success', [PlanController::class, 'success'])->name('plan.success');
    Route::post('comment/post', [CommentController::class, 'postComment'])->name('comment.post');
});

//---------------------Mypage-----------------------------------------------
Route::group(['middleware' => ['auth:web']], function () {
    Route::get('/payment_history', [MypageController::class, 'paymentHistory'])->name('payment_history');
    Route::get('/contribution_comments', [MypageController::class, 'contributionComments'])->name('contribution_comments');
    Route::get('/purchased_projects', [MypageController::class, 'purchasedProjects'])->name('purchased_projects');
    Route::get('/liked_projects', [MypageController::class, 'likedProjects'])->name('liked_projects');
    Route::get('/profile', [MypageController::class, 'profile'])->name('profile');
    Route::patch('/profile/{user}', [MypageController::class, 'updateProfile'])->name('update_profile');
    Route::get('/withdraw', [MypageController::class, 'withdraw'])->name('withdraw');
    Route::delete('/withdraw/{user}', [MypageController::class, 'delete_user'])->name('delete_user');

    // NOTICE: 現状優先度的にメッセージ機能の実装は間に合わなそうなので、コメントアウトにいたします...
    // Route::resource('message', MessageController::class)->only(['index','show']);
    // Route::post('message/{user_plan_cheering}', [MessageController::class,'store'])->name('message_content.store');
    // Route::get('message/{message_content}/file_download', [MessageController::class,'file_download'])->name('message_content.file_download');
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
Route::get('/question', [TopPageController::class, 'question'])->name('question');
Route::get('/tradelaw', [TopPageController::class, 'tradelaw'])->name('tradelaw');
Route::get('/terms', [TopPageController::class, 'terms'])->name('terms');
Route::get('/privacy_policy', [TopPageController::class, 'privacyPolicy'])->name('privacy_policy');

//---------------------Forgot Password-----------------------------------------------
Route::get('/forgot_password', [MypageController::class, 'forgotPassword'])->name('forgot_password');
Route::post('/send_reset_password_mail', [MypageController::class, 'sendResetPasswordMail'])->name('send_reset_password_mail');
// --------------------password reset-------------------
Route::get('/password_reset/{token}', [PasswordResetController::class, 'reset'])->name('password.reset');
Route::post('/password_reset', [PasswordResetController::class, 'update'])->name('password.update');

// --------------------inqury-------------------
Route::get('/inquiry/create', [InquiryController::class, 'createInquiry'])->name('inquiry.create');
Route::post('/inquiry/send', [InquiryController::class, 'sendInquiry'])->name('inquiry.send');
