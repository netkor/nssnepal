<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\TeamController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\DownloadController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\SupportController;
use App\Http\Controllers\OpportunityController;
use App\Http\Controllers\AdminAuthController;

use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\ProjectController as AdminProjectController;
use App\Http\Controllers\Admin\ContactMessageController as AdminContactMessageController;
use App\Http\Controllers\Admin\SettingController as AdminSettingController;

/*
|--------------------------------------------------------------------------
| Public Routes
|--------------------------------------------------------------------------
*/

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/about-us', [PageController::class, 'about'])->name('about');
Route::get('/teams', [TeamController::class, 'index'])->name('team');

Route::get('/projects', [ProjectController::class, 'index'])->name('projects.index');
Route::get('/projects/{project}', [ProjectController::class, 'show'])->name('projects.show');

Route::get('/gallery', [GalleryController::class, 'index'])->name('gallery.index');
Route::get('/gallery/{album}', [GalleryController::class, 'album'])->name('gallery.album');

Route::get('/news-and-events', [NewsController::class, 'index'])->name('news.index');
Route::get('/news-and-events/{newsEvent}', [NewsController::class, 'show'])->name('news.show');

Route::get('/downloads/publications', [DownloadController::class, 'publications'])->name('downloads.publications');
Route::get('/downloads/reports', [DownloadController::class, 'reports'])->name('downloads.reports');
Route::get('/downloads/{download}/get', [DownloadController::class, 'download'])->name('downloads.get');

Route::get('/contact-us', [ContactController::class, 'index'])->name('contact.index');
Route::post('/contact-us', [ContactController::class, 'store'])->name('contact.store')->middleware('throttle:3,1');

Route::get('/support-us', [SupportController::class, 'index'])->name('support');
Route::get('/opportunities', [OpportunityController::class, 'index'])->name('opportunities');

/*
|--------------------------------------------------------------------------
| Admin Auth Routes
|--------------------------------------------------------------------------
*/

Route::get('/admin/login', [AdminAuthController::class, 'showLoginForm'])->name('admin.login');
Route::post('/admin/login', [AdminAuthController::class, 'login'])->name('admin.login.submit');
Route::post('/admin/logout', [AdminAuthController::class, 'logout'])->name('logout');
Route::redirect('/admin', '/admin/dashboard');

/*
|--------------------------------------------------------------------------
| Protected Admin Routes
|--------------------------------------------------------------------------
*/

Route::middleware('admin')->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');
    
    // Projects CRUD
    Route::resource('projects', AdminProjectController::class);
    
    // Team Members CRUD
    Route::resource('team-members', \App\Http\Controllers\Admin\TeamMemberController::class);
    
    // Sliders CRUD
    Route::resource('sliders', \App\Http\Controllers\Admin\SliderController::class);

    // Gallery Albums CRUD
    Route::resource('gallery-albums', \App\Http\Controllers\Admin\GalleryAlbumController::class);
    Route::post('/gallery-albums/{gallery_album}/images', [\App\Http\Controllers\Admin\GalleryAlbumController::class, 'addImage'])->name('gallery-albums.images.store');
    Route::delete('/gallery-images/{image}', [\App\Http\Controllers\Admin\GalleryAlbumController::class, 'deleteImage'])->name('gallery-albums.images.destroy');

    // News & Events CRUD
    Route::resource('news-events', \App\Http\Controllers\Admin\NewsEventController::class);

    // Downloads CRUD
    Route::resource('downloads', \App\Http\Controllers\Admin\DownloadController::class);

    // Opportunities CRUD
    Route::resource('opportunities', \App\Http\Controllers\Admin\OpportunityController::class);

    // Partners CRUD
    Route::resource('partners', \App\Http\Controllers\Admin\PartnerController::class);
    
    // Messages Inbox
    Route::get('/messages', [AdminContactMessageController::class, 'index'])->name('messages.index');
    Route::get('/messages/{message}', [AdminContactMessageController::class, 'show'])->name('messages.show');
    Route::delete('/messages/{message}', [AdminContactMessageController::class, 'destroy'])->name('messages.destroy');
    
    // Site Settings
    Route::get('/settings', [AdminSettingController::class, 'edit'])->name('settings.edit');
    Route::post('/settings', [AdminSettingController::class, 'update'])->name('settings.update');
    
    // Rich Text Editor Image Upload
    Route::post('/upload-image', [AdminSettingController::class, 'uploadImage'])->name('upload-image');
});
