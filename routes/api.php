<?php

use App\Http\Controllers\AgentController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CompaniesImgController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\ImpactController;
use App\Http\Controllers\OpportunityController;
use App\Http\Controllers\PartnerController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProgramController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\BgVideoController;
use App\Http\Controllers\MainTitleController;
use App\Http\Controllers\PropertyImgController;
use App\Http\Controllers\CollageController;
use App\Http\Controllers\AppMockupController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\TestimonialController;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

//ROUTES FOR API
Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

//ROUTES FOR API

Route::post('register', [UserController::class, 'registerClient']);

Route::post('login', [UserController::class, 'loginUserExample']);

Route::post('registerSupport', [UserController::class, 'registerSupport']);

//for landville
Route::get('/title', [MainTitleController::class, 'getTitle']);
Route::get('/property', [PropertyImgController::class, 'getImage']);
Route::get('/video', [BgVideoController::class, 'getVideo'])->name('api.video');
Route::get('/collage', [CollageController::class, 'getCollage'])->name('api.collage');
Route::get('/mockup', [AppMockupController::class, 'getMockup'])->name('api.mockup');
Route::get('/service_img', [CompaniesImgController::class, 'getServiceImage'])->name('api.service_img');
Route::get('/services', [ServiceController::class, 'getService'])->name('api.service');
Route::get('/blogs', [BlogController::class, 'getBlog'])->name('api.blog');
Route::apiResource('testimonials', TestimonialController::class);
Route::get('/testimonials', [TestimonialController::class, 'getTestimonials']);

//add this middleware to ensure that everCy request is authenticated
Route::middleware('auth:api')->group(function () {

    Route::get('/profile', [UserController::class, 'getProfile']);

    Route::post('/profile/update', [UserController::class, 'updateProfile']);

    Route::post('/profile/avatar', [UserController::class, 'updateAvatar']);

    Route::post('/updateFCMToken', [UserController::class, 'updateFCMToken']);

    Route::get('/posts', [PostController::class, 'getPosts']);
    Route::get('/posts/search', [PostController::class, 'search']);
    Route::get('/posts/{id}', [PostController::class, 'getPostDetails']);
    Route::post('/posts', [PostController::class, 'store']);
    Route::post('/posts/{id}/edit', [PostController::class, 'editPost']);
    Route::delete('/posts/delete', [PostController::class, 'deletePost']);
    Route::post('posts/comment', [CommentController::class, 'store']);

    Route::get('/impacts', [ImpactController::class, 'getImpacts']);
    Route::get('/impacts/search', [ImpactController::class, 'search']);
    Route::get('/impacts/{id}', [ImpactController::class, 'getImpactDetails']);
    Route::post('/impacts', [ImpactController::class, 'store']);
    Route::post('/impacts/{id}/edit', [ImpactController::class, 'editImpact']);
    Route::delete('/impacts/delete', [ImpactController::class, 'deleteImpact']);
    Route::post('impacts/comment', [CommentController::class, 'store']);

    Route::get('/opportunities', [OpportunityController::class, 'getOpportunities']);
    Route::get('/opportunities/search', [OpportunityController::class, 'search']);
    Route::get('/opportunities/{id}', [OpportunityController::class, 'getOpportunityDetails']);
    Route::post('/opportunities', [OpportunityController::class, 'store']);
    Route::post('/opportunities/{id}/edit', [OpportunityController::class, 'editOpportunity']);
    Route::delete('/opportunities/delete', [OpportunityController::class, 'deleteOpportunity']);
    Route::post('opportunities/comment', [CommentController::class, 'store']);

    Route::get('/partners', [PartnerController::class, 'getPartners']);
    Route::get('/partners/search', [PartnerController::class, 'search']);
    Route::get('/partners/{id}', [PartnerController::class, 'getPartnerDetails']);
    Route::post('/partners', [PartnerController::class, 'store']);
    Route::post('/partners/{id}/edit', [PartnerController::class, 'editPartner']);
    Route::delete('/partners/delete', [PartnerController::class, 'deletePartner']);
    Route::post('partners/comment', [CommentController::class, 'store']);

    Route::get('/programs', [ProgramController::class, 'getPrograms']);
    Route::get('/programs/search', [ProgramController::class, 'search']);
    Route::get('/programs/{id}', [ProgramController::class, 'getProgramDetails']);
    Route::post('/programs', [ProgramController::class, 'store']);
    Route::post('/programs/{id}/edit', [ProgramController::class, 'editProgram']);
    Route::delete('/programs/delete', [ProgramController::class, 'deleteProgram']);
    Route::post('programs/comment', [CommentController::class, 'store']);

    Route::get('/reports', [ReportController::class, 'getReports']);
    Route::get('/reports/search', [ReportController::class, 'search']);
    Route::get('/reports/{id}', [ReportController::class, 'getReportDetails']);
    Route::post('/reports', [ReportController::class, 'store']);
    Route::post('/reports/{id}/edit', [ReportController::class, 'editReport']);
    Route::delete('/reports/delete', [ReportController::class, 'deleteReport']);
    Route::post('reports/comment', [CommentController::class, 'store']);

    Route::get('comments/{id}/show', [CommentController::class, 'getComment']);
    Route::post('comments/{id}/edit', [CommentController::class, 'editComment']);
    Route::delete('comments/delete', [CommentController::class, 'deleteComment']);
    Route::post('comments/reply', [CommentController::class, 'reply']);
    Route::delete('replies/delete', [CommentController::class, 'deleteReply']);

    Route::delete('/delete/{id}', [PostController::class, 'destroy']);



});

    Route::post('/createCategory', [CategoryController::class, 'store']);
    Route::get('getCategories', [CategoryController::class, 'getCategories']);

    Route::get('/getCategory/{id}', [CategoryController::class, 'getCategory']);

Route::prefix('guest')->group(function () {
    Route::get('/posts', [PostController::class, 'getPosts']);
    Route::get('/posts/search', [PostController::class, 'search']);
    Route::get('/posts/{id}', [PostController::class, 'getPostDetails']);
});

Route::get('/postsByCategory', [PostController::class, 'getPostsByCategory']);
Route::post('/forgotPassword', [UserController::class, 'forgotPassword']);
Route::post('/verifyCode', [UserController::class, 'verifyCode']);
Route::post('/resetPassword', [UserController::class, 'resetPassword']);
