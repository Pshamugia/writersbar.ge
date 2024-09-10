<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\postsController;
use App\Http\Controllers\QuizzController;
use App\Http\Controllers\VideoController;
use App\Http\Controllers\AuthorsController;
use App\Http\Controllers\ArticlesController;
use App\Http\Controllers\GalleriesController;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\GoogleController;
use App\Http\Controllers\ProfileController;

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

Route::post('/language', 'LanguageController@setLanguage')->name('language.set');


 Route::get('profile/show', [ProfileController::class, 'show'])->name('profile.show');


Route::get('auth/google', [GoogleController::class, 'redirectToGoogle']);
 Route::get('/auth/google/callback', 'App\Http\Controllers\GoogleController@handleGoogleCallback');


Route::get('/', [ArticlesController::class, 'welcome'])->name('welcome');
Route::get('/privacy', [ArticlesController::class, 'privacy'])->name('privacy');
Route::get('/terms', [ArticlesController::class, 'terms'])->name('terms');
Route::get('/full/{title_ka}/{id}', [ArticlesController::class, 'full'])->name('full');
Route::get('/fullAuthor/{author_ka}/{id}', [AuthorsController::class, 'fullAuthor'])->name('fullAuthor');
Route::get('/search', [ArticlesController::class, 'search'])->name('search');

Route::get('/cat/{id}', [ArticlesController::class, 'events'])->name('events');
//Route::get('/events_quizz/{id}', [ArticlesController::class, 'events'])->name('events_quizz');
Route::get('/events_quizz/{id}', [QuizzController::class, 'events_quizz'])->name('events_quizz');

Route::get('/projects', [ArticlesController::class, 'projects'])->name('projects');
Route::get('/gallery', [GalleriesController::class, 'gallery'])->name('gallery');
Route::get('/full_gallery/{title}/{id}', [GalleriesController::class, 'full_gallery'])->name('full_gallery');
Route::post('contact', [ArticlesController::class, 'contact'])->name('contact');
Route::get('/booking_login', [UserController::class, 'booking_login'])->name('booking.login');
Route::post('/booking_auth', [UserController::class, 'booking_auth'])->name('booking.auth');
Route::get('/booking_room', [UserController::class, 'booking_room'])->middleware('booking_auth')->name('booking.room');
Route::get('/booking_register', [UserController::class, 'booking_register'])->name('booking.register');
Route::post('booking_create', [UserController::class, 'booking_create'])->name('booking.create');
Route::get('booking_logout', [UserController::class, 'booking_logout'])->name('booking.logout');
Route::post('booking_send', [UserController::class, 'booking_send'])->name('booking.send');

Route::get('/forgot-password', function () {
    return view('auth.forgot-password');
})->middleware('guest')->name('password.request');



// ადმინპანელი

Route::get('/admin', [ArticlesController::class, 'index'])->middleware(['auth'])->name('admin_index');
//Route::get('/admin', [CategoriesController::class, 'index'])->name('admin_index');
Route::get('admin/articles/edit/{id}', [AdminController::class, 'admin_articles_edit'])->middleware(['auth'])->name('admin.articles.edit');
Route::post('admin/articles/update/{id}', [AdminController::class, 'admin_articles_update'])->middleware(['auth'])->name('admin.articles.update');
Route::get('/admin/article/{id}',[AdminController::class, 'delete'])->middleware(['auth'])->name('admin.article.delete');

// ფოტო გალერია
Route::get('/admin/gallery/photo', [GalleriesController::class, 'index'])->middleware(['auth'])->name('admin.gallery.photo');
Route::get('/admin/gallery/photo/add', [GalleriesController::class, 'add'])->middleware(['auth'])->name('admin.gallery.photo.add');
Route::get('/admin/gallery/photo/edit/{id}', [GalleriesController::class, 'edit'])->middleware(['auth'])->name('admin.gallery.photo.edit');
Route::post('/admin/gallery/photo/store', [GalleriesController::class, 'store'])->middleware(['auth'])->name('admin.gallery.photo.store');
Route::post('/admin/gallery/upload', [GalleriesController::class, 'upload'])->middleware(['auth'])->name('admin.gallery.upload');
Route::get('/admin/gallery/photo{id}',[GalleriesController::class, 'delete'])->middleware(['auth'])->name('admin.gallery.photo.delete');
Route::post('/admin/gallery/photo/update/{id}', [GalleriesController::class, 'admin_gallery_photo_update'])->middleware(['auth'])->name('admin.gallery.photo.update');

// ვიდეო გალერია
Route::get('/video', [VideoController::class, 'video_view'])->name('video');
Route::get('/full_video/{title_ka}/{id}', [VideoController::class, 'full_video'])->name('full_video');


Route::get('/admin/gallery/video', [VideoController::class, 'view'])->middleware(['auth'])->name('admin.gallery.video');
Route::get('/admin/gallery/video/add', [VideoController::class, 'add'])->middleware(['auth'])->name('admin.gallery.video.add');
Route::post('/admin/gallery/video/store', [VideoController::class, 'store'])->middleware(['auth'])->name('admin.gallery.video.store');
Route::get('/admin/gallery/video/edit/{id}', [VideoController::class, 'edit'])->middleware(['auth'])->name('admin.gallery.video.edit');
Route::post('/admin/gallery/video/update/{id}', [VideoController::class, 'admin_gallery_video_update'])->middleware(['auth'])->name('admin.gallery.video.update');
Route::get('/admin/gallery/video{id}',[VideoController::class, 'delete'])->middleware(['auth'])->name('admin.gallery.video.delete');



Route::get('/admin/search/search_admin', [ArticlesController::class, 'search_admin'])->name('search_admin');



Route::get('/admin/article', [ArticlesController::class, 'index'])->middleware(['auth'])->name('admin.article');
Route::get('/admin/articles/add', [ArticlesController::class, 'add'])->middleware(['auth'])->name('admin.article.add');
Route::post('/admin/articles/store', [ArticlesController::class, 'store'])->middleware(['auth'])->name('admin.article.store');

Route::get('/admin/category/index', [CategoriesController::class, 'index'])->middleware(['auth'])->name('admin.category.index');
Route::get('/admin/category/add', [CategoriesController::class, 'add'])->middleware(['auth'])->name('admin.category.add');
Route::post('/admin/category/store', [CategoriesController::class, 'store'])->middleware(['auth'])->name('admin.category.store');
Route::get('/admin/category/edit/{id}', [CategoriesController::class, 'edit'])->middleware(['auth'])->name('admin.category.edit');
Route::post('/admin/category/update/{id}', [CategoriesController::class, 'update'])->middleware(['auth'])->name('admin.category.update');
Route::get('/admin/category/delete/{id}', [CategoriesController::class, 'delete'])->middleware(['auth'])->name('admin.category.delete');

//author admin

Route::get('/admin/authors/index', [AuthorsController::class, 'index'])->middleware(['auth'])->name('admin.authors');
Route::get('/admin/authors/add', [AuthorsController::class, 'add'])->middleware(['auth'])->name('admin.authors.add');
Route::post('/admin/authors/store', [AuthorsController::class, 'store'])->middleware(['auth'])->name('admin.authors.store');
Route::post('/admin/authors/delete',[AuthorsController::class, 'author_delete'])->middleware(['auth'])->name('admin.authors.delete');
Route::post('/admin/authors/update/{id}',[AuthorsController::class, 'author_update'])->middleware(['auth'])->name('admin.authors.update');


//user

Route::get('/admin/user/log', [UserController::class, 'admin_user'])->middleware(['auth'])->name('admin.user');
Route::get('/admin/user/edit{id}', [UserController::class, 'edit_user'])->middleware(['auth'])->name('edit.user');
Route::post('/admin/user/update/{id}', [UserController::class, 'update_user'])->middleware(['auth'])->name('admin.user.update');
Route::get('/admin/user/user_view', [UserController::class, 'user_view'])->middleware(['auth'])->name('admin.user.user_view');
Route::get('/admin/user/user_register', [UserController::class, 'user_register'])->middleware(['auth'])->name('admin.user.user_register');
Route::get('/admin/user/user_delete/{id}', [UserController::class, 'user_delete'])->middleware(['auth'])->name('admin.user.user_delete');


// Quizz
Route::get('/quizz/{id}/{mainTitle_ka}', [QuizzController::class, 'quizz_full'])->name('quizz_full');

Route::get('/admin/quizz/quizz_view', [QuizzController::class, 'admin_quizz'])->middleware(['auth'])->name('admin.quizz');
Route::get('/admin/quizz/add_quizz', [QuizzController::class, 'add_quizz'])->middleware(['auth'])->name('add.quizz');
Route::post('/admin/quizz/store', [QuizzController::class, 'store'])->middleware(['auth'])->name('admin.quizz.store');
Route::get('/admin/quizz/quizz_view/{id}',[QuizzController::class, 'quizz_delete'])->middleware(['auth'])->name('quizz.delete');
Route::get('/quizz_results', [QuizzController::class, 'quizz_results'])->name('quizz_results');
Route::get('/admin/quizz/edit/{id}', [QuizzController::class, 'quizz_edit'])->middleware(['auth'])->name('quizz.edit');
Route::post('/admin/quizz/update/{id}', [QuizzController::class, 'quizz_update'])->middleware(['auth'])->name('quizz.update');
Route::get('/admin/quizz/quizz_view{id}',[QuizzController::class, 'hidden'])->middleware(['auth'])->name('quizz.hidden');


//authorisation



Route::get('/admin/login', [UserController::class, 'login'])->name('admin.login');
Route::post('/admin/auth', [UserController::class, 'auth'])->name('admin.auth');
Route::post('/user/create', [UserController::class, 'create'])->name('user.create');
Route::get('/admin/logout', [UserController::class, 'logout'])->name('admin.logout');


// Password Reset

Route::get('forget-password', [ForgotPasswordController::class, 'showForgetPasswordForm'])->name('forget.password.get');
Route::post('forget-password', [ForgotPasswordController::class, 'submitForgetPasswordForm'])->name('forget.password.post');
Route::get('reset-password/{token}', [ForgotPasswordController::class, 'showResetPasswordForm'])->name('reset.password.get');
Route::post('reset-password', [ForgotPasswordController::class, 'submitResetPasswordForm'])->name('reset.password.post');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});
