<?php

use App\Http\Controllers\CommentController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ImpactController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\AppMockupController;
use App\Http\Controllers\CollageController;
use App\Http\Controllers\PropertyImgController;
use App\Http\Controllers\ServiceImgController;
use App\Http\Controllers\TestController;
use App\Http\Controllers\MainTitleController;
use App\Http\Controllers\CompaniesImgController;
use App\Http\Controllers\OpportunityController;
use App\Http\Controllers\PartnerController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProgramController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\BgVideoController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\TestimonialController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes(['register' => false]);

Route::get('/', function () {
    return redirect()->route('login');
});

Route::middleware('auth')->group(function () {

    Route::post('/update-user-status', 'UserController@updateUserStatus');

    Route::get('/users/clients', [UserController::class, 'index_clients'])->name('index.clients');
    Route::post('/users/register', [UserController::class, 'registerClient'])->name('register.users');
    Route::get('/users/{id}/edit', [UserController::class, 'edit'])->name('edit.users');
    Route::get('/users/show/{id}', [UserController::class, 'show'])->name('show.users');
    Route::get('/users/confirm-delete/{id}', [UserController::class, 'confirmDelete'])->name('confirm_delete.users');
    Route::get('/users/create', [UserController::class, 'create'])->name('create.users');
    Route::get('/users/activate/{id}', [UserController::class, 'activate'])->name('activate.user');
    Route::delete('/users/deletePost', [UserController::class, 'deletePost'])->name('deletePost.users');

    Route::get('/agents', [AgentController::class, 'index'])->name('index.agents');
    Route::get('/agents/create', [AgentController::class, 'create'])->name('create.agents');
    Route::post('/agents/store', [AgentController::class, 'store'])->name('store.agents');
    Route::get('/agents/edit/{id}', [AgentController::class, 'edit'])->name('edit.agents');

    Route::get('/posts', [PostController::class, 'index'])->name('index.posts');
    Route::get('/posts/create', [PostController::class, 'create'])->name('create.posts');
    Route::post('/posts/store', [PostController::class, 'store'])->name('store.posts');
    Route::get('/posts/{id}/edit', [PostController::class, 'edit'])->name('edit.posts');
    Route::get('/posts/show/{id}', [PostController::class, 'show'])->name('show.posts');
    Route::put('/posts/{post}', [PostController::class, 'update'])->name('update.posts');
    Route::get('/posts/confirm-delete/{id}', [PostController::class, 'confirmDelete'])->name('confirm_delete.posts');
    Route::delete('/posts/deletePost', [PostController::class, 'deletePost'])->name('deletePost.posts');

    Route::get('/impacts', [ImpactController::class, 'index'])->name('index.impacts');
    Route::get('/impacts/create', [ImpactController::class, 'create'])->name('create.impacts');
    Route::post('/impacts/store', [ImpactController::class, 'store'])->name('store.impacts');
    Route::get('/impacts/{id}/edit', [ImpactController::class, 'edit'])->name('edit.impacts');
    Route::get('/impacts/show/{id}', [ImpactController::class, 'show'])->name('show.impacts');
    Route::put('/impacts/{post}', [ImpactController::class, 'update'])->name('update.impacts');
    Route::get('/impacts/confirm-delete/{id}', [ImpactController::class, 'confirmDelete'])->name('confirm_delete.impacts');
    Route::delete('/impacts/deletePost', [ImpactController::class, 'deletePost'])->name('deletePost.impacts');

    Route::get('/programs', [ProgramController::class, 'index'])->name('index.programs');
    Route::get('/programs/create', [ProgramController::class, 'create'])->name('create.programs');
    Route::post('/programs/store', [ProgramController::class, 'store'])->name('store.programs');
    Route::get('/programs/{id}/edit', [ProgramController::class, 'edit'])->name('edit.programs');
    Route::get('/programs/show/{id}', [ProgramController::class, 'show'])->name('show.programs');
    Route::put('/programs/{post}', [ProgramController::class, 'update'])->name('update.programs');
    Route::get('/programs/confirm-delete/{id}', [ProgramController::class, 'confirmDelete'])->name('confirm_delete.programs');
    Route::delete('/programs/deletePost', [ProgramController::class, 'deletePost'])->name('deletePost.programs');

    Route::get('/partners', [PartnerController::class, 'index'])->name('index.partners');
    Route::get('/partner/create', [PartnerController::class, 'create'])->name('create.partners');
    Route::get('/partners/store', [PartnerController::class, 'store'])->name('store.partners');
    Route::get('/partners/{id}/edit', [PartnerController::class, 'edit'])->name('edit.partners');
    Route::get('/partners/show/{id}', [PartnerController::class, 'show'])->name('show.partners');
    Route::put('/partners/{post}', [PartnerController::class, 'update'])->name('update.partners');
    Route::get('/partners/confirm-delete/{id}', [PartnerController::class, 'confirmDelete'])->name('confirm_delete.partners');
    Route::delete('/partners/deletePost', [PartnerController::class, 'deletePost'])->name('deletePost.partners');



Route::resource('testimonials', TestimonialController::class);


    // BgVideo Routes
Route::get('/bgVideos', [BgVideoController::class, 'index'])->name('bg_videos.index');
Route::get('/bg_videos/create', [BgVideoController::class, 'create'])->name('bg_videos.create');
Route::post('bgVideos', [BgVideoController::class, 'store'])->name('bg_videos.store');
Route::get('/bg_videos/{bg_video}/edit', [BgVideoController::class, 'edit'])->name('bg_videos.edit');
Route::put('/bg_videos/{bg_video}', [BgVideoController::class, 'update'])->name('bg_videos.update');
Route::delete('/bg_videos/{bg_video}', [BgVideoController::class, 'destroy'])->name('bg_videos.destroy');

    // PropertyImg Routes
Route::get('/propatiz', [PropertyImgController::class, 'index'])->name('partners.index');
Route::get('/property_images/create', [PropertyImgController::class, 'create'])->name('property_images.create');
Route::match(['get', 'post'], 'property_images', [PropertyImgController::class, 'store'])->name('property_images.store');
Route::get('/property_images/{property_image}', [PropertyImgController::class, 'show'])->name('property_images.show');
Route::get('/property_images/{property_image}/edit', [PropertyImgController::class, 'edit'])->name('property_images.edit');
Route::put('/property_images/{property_image}', [PropertyImgController::class, 'update'])->name('property_images.update');
Route::delete('/property_images/{property_image}', [PropertyImgController::class, 'destroy'])->name('property_images.destroy');

    // Service Routes
    Route::get('/services', [ServiceController::class, 'index'])->name('services.index');
    Route::get('/services/create', [ServiceController::class, 'create'])->name('services.create');
    Route::post('/services', [ServiceController::class, 'store'])->name('services.store');
    Route::get('/services/{service}', [ServiceController::class, 'show'])->name('services.show');
    Route::get('/services/{service}/edit', [ServiceController::class, 'edit'])->name('services.edit');
    Route::put('/services/{service}', [ServiceController::class, 'update'])->name('services.update');
    Route::delete('/services/{service}', [ServiceController::class, 'destroy'])->name('services.destroy');



// MainTitle Routes
Route::get('/main_titles', [MainTitleController::class, 'index'])->name('mainTitles.index');
Route::get('/main_titles/create', [MainTitleController::class, 'create'])->name('mainTitles.create');
Route::post('/main_titles', [MainTitleController::class, 'store'])->name('mainTitles.store');
Route::get('/main_titles/{main_title}', [MainTitleController::class, 'show'])->name('mainTitles.show');
Route::get('/main_titles/{main_title}/edit', [MainTitleController::class, 'edit'])->name('mainTitles.edit');
Route::put('/main_titles/{main_title}', [MainTitleController::class, 'update'])->name('mainTitles.update');
Route::delete('/main_titles/{main_title}', [MainTitleController::class, 'destroy'])->name('mainTitles.destroy');
// MainTitle End


// PropertyImg Routes
Route::get('/property_images', [PropertyImgController::class, 'index'])->name('property_images.index');
Route::get('/property_images/create', [PropertyImgController::class, 'create'])->name('property_images.create');
Route::post('property_images', [PropertyImgController::class, 'store'])->name('property_images.store');
Route::get('/property_images/{property_image}', [PropertyImgController::class, 'show'])->name('property_images.show');
Route::get('/property_images/{property_image}/edit', [PropertyImgController::class, 'edit'])->name('property_images.edit');
Route::put('/property_images/{property_image}', [PropertyImgController::class, 'update'])->name('property_images.update');
Route::delete('/property_images/{property_image}', [PropertyImgController::class, 'destroy'])->name('property_images.destroy');

// ExclusiveServiceImage Routes
Route::get('/service_img', [CompaniesImgController::class, 'index'])->name('service_img.index');
Route::get('/service_img/create', [CompaniesImgController::class, 'create'])->name('service_img.create');
Route::post('/service_img', [CompaniesImgController::class, 'store'])->name('service_img.store');
Route::get('/service_img/{service_img}', [CompaniesImgController::class, 'show'])->name('service_img.show');
Route::get('/service_img/{service_img}/edit', [CompaniesImgController::class, 'edit'])->name('service_img.edit');
Route::put('/service_img/{service_img}', [CompaniesImgController::class, 'update'])->name('service_img.update');
Route::delete('/service_img/{service_img}', [CompaniesImgController::class, 'destroy'])->name('service_img.destroy');

// AppMockup Routes
Route::get('/app_mockups', [AppMockupController::class, 'index'])->name('app_mockups.index');
Route::get('/app_mockups/create', [AppMockupController::class, 'create'])->name('app_mockups.create');
Route::post('/app_mockups', [AppMockupController::class, 'store'])->name('app_mockups.store');
Route::get('/app_mockups/{app_mockup}', [AppMockupController::class, 'show'])->name('app_mockups.show');
Route::get('/app_mockups/{app_mockup}/edit', [AppMockupController::class, 'edit'])->name('app_mockups.edit');
Route::put('/app_mockups/{app_mockup}', [AppMockupController::class, 'update'])->name('app_mockups.update');
Route::delete('/app_mockups/{app_mockup}', [AppMockupController::class, 'destroy'])->name('app_mockups.destroy');

// Collage Routes
Route::get('/collages', [CollageController::class, 'index'])->name('collages.index');
Route::get('/collages/create', [CollageController::class, 'create'])->name('collages.create');
Route::post('/collages', [CollageController::class, 'store'])->name('collages.store');
Route::get('/collages/{collage}', [CollageController::class, 'show'])->name('collages.show');
Route::get('/collages/{collage}/edit', [CollageController::class, 'edit'])->name('collages.edit');
Route::put('/collages/{collage}', [CollageController::class, 'update'])->name('collages.update');
Route::delete('/collages/{collage}', [CollageController::class, 'destroy'])->name('collages.destroy');

// Blog Routes
Route::get('/blogs', [BlogController::class, 'index'])->name('blogs.index');
Route::get('/blogs/create', [BlogController::class, 'create'])->name('blogs.create');
Route::post('/blogs', [BlogController::class, 'store'])->name('blogs.store');
Route::get('/blogs/{blog}', [BlogController::class, 'show'])->name('blogs.show');
Route::get('/blogs/{blog}/edit', [BlogController::class, 'edit'])->name('blogs.edit');
Route::put('/blogs/{blog}', [BlogController::class, 'update'])->name('blogs.update');
Route::delete('/blogs/{blog}', [BlogController::class, 'destroy'])->name('blogs.destroy');

// Service Routes
Route::get('/services', [ServiceController::class, 'index'])->name('services.index');
Route::get('/services/create', [ServiceController::class, 'create'])->name('services.create');
Route::post('/services', [ServiceController::class, 'store'])->name('services.store');
Route::get('/services/{service}', [ServiceController::class, 'show'])->name('services.show');
Route::get('/services/{service}/edit', [ServiceController::class, 'edit'])->name('services.edit');
Route::put('/services/{service}', [ServiceController::class, 'update'])->name('services.update');
Route::delete('/services/{service}', [ServiceController::class, 'destroy'])->name('services.destroy');

// Test Routes
Route::get('/tests', [TestController::class, 'index'])->name('tests.index');
Route::get('/tests/create', [TestController::class, 'create'])->name('tests.create');
Route::post('/tests', [TestController::class, 'store'])->name('tests.store');
Route::get('/tests/{test}', [TestController::class, 'show'])->name('tests.show');
Route::get('/tests/{test}/edit', [TestController::class, 'edit'])->name('tests.edit');
Route::put('/tests/{test}', [TestController::class, 'update'])->name('tests.update');
Route::delete('/tests/{test}', [TestController::class, 'destroy'])->name('tests.destroy');




    Route::get('/reports', [ReportController::class, 'index'])->name('index.reports');
    Route::get('/reports/create', [ReportController::class, 'create'])->name('create.reports');
    Route::get('/reports/store', [ReportController::class, 'store'])->name('store.reports');
    Route::get('/reports/{id}/edit', [ReportController::class, 'edit'])->name('edit.reports');
    Route::get('/reports/show/{id}', [ReportController::class, 'show'])->name('show.reports');
    Route::put('/reports/{post}', [ReportController::class, 'update'])->name('update.reports');
    Route::get('/reports/confirm-delete/{id}', [ReportController::class, 'confirmDelete'])->name('confirm_delete.reports');
    Route::delete('/reports/deletePost', [ReportController::class, 'deletePost'])->name('deletePost.reports');

    Route::get('/opportunities', [OpportunityController::class, 'index'])->name('index.opportunities');
    Route::get('/opportunities/create', [OpportunityController::class, 'create'])->name('create.opportunities');
    Route::get('/opportunities/store', [OpportunityController::class, 'store'])->name('store.opportunities');
    Route::get('/opportunities/{id}/edit', [OpportunityController::class, 'edit'])->name('edit.opportunities');
    Route::get('/opportunities/show/{id}', [OpportunityController::class, 'show'])->name('show.opportunities');
    Route::put('/opportunities/{post}', [OpportunityController::class, 'update'])->name('update.opportunities');
    Route::get('/opportunities/confirm-delete/{id}', [OpportunityController::class, 'confirmDelete'])->name('confirm_delete.opportunities');
    Route::delete('/opportunities/deletePost', [OpportunityController::class, 'deletePost'])->name('deletePost.opportunities');

    Route::get('/dashboard', [DashboardController::class, 'dashboard'])->name('dashboard');
    Route::get('/settings', [SettingsController::class, 'index'])->name('index.settings');
    Route::post('/settings/store', [SettingsController::class, 'store'])->name('store.settings');

});

//ROUTES FOR POST CONTROLLER

Route::get('/index', [PostController::class, 'create'])->name('posts.index');
Route::get('/create', [PostController::class, 'create'])->name('posts.create');

Route::post('/store', [PostController::class, 'store'])->name('posts.store');

Route::get('/show/{post:desc}', [PostController::class, 'show'])->name('posts.show');

Route::post('/comments', [CommentController::class, 'store'])->name('comment.store');

Route::post('/reply/store', [CommentController::class, 'replyStore'])->name('reply.add');

Route::get('/delete/{id}', [PostController::class, 'destroy']);

//ROUTES FOR COMMENT CONTROLLER

Route::post('/posts/{post}/comments ', [CommentController::class, 'store']);

Route::delete('/comments/{comment}', [CommentController::class, 'destroy']);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
