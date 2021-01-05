<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductCatagoryController;
use App\Http\Controllers\ProductTypeController;
use App\Http\Controllers\ProductStatusController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\HomepageController;
use App\Http\Controllers\StartpageController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\LogoController;
use App\Http\Controllers\BannerController;
use App\Http\Controllers\AdvertistingController;
use App\Http\Controllers\VideoController;
use App\Http\Controllers\AnnounceController;
use App\Http\Controllers\InfoController;
use App\Http\Controllers\HelpController;
use App\Http\Controllers\MoreController;
use App\Http\Controllers\MarqueeController;
use App\Http\Controllers\FileUpload;
use Intervention\Image\Facades\Image;

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

Route::get('/', function () {
    return view('home');
})->name('home')->middleware('auth');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

Route::resource('product_catagories', ProductCatagoryController::class);

Route::resource('product_types', ProductTypeController::class);

Route::resource('product_statuses', ProductStatusController::class);

Route::resource('products', ProductController::class);

Route::get('/projects/{project}/homepage', [App\Http\Controllers\ProjectController::class, 'homepage'])
       ->name('projects.homepage');

Route::get('/projects/{project}/startpages', [App\Http\Controllers\ProjectController::class, 'startpage'])
       ->name('projects.startpage');

Route::post('/startpages/{id}', 'App\Http\Controllers\StartpageController@newstore')
       ->name('startpages.newstore');

Route::resource('startpages', StartpageController::class);

Route::resource('projects', ProjectController::class);

Route::get('/homepage/{project}/addlogo', [App\Http\Controllers\HomepageController::class, 'addlogo'])
       ->name('homepage.addlogo');

Route::get('/homepage/{project}/addbanner', [App\Http\Controllers\HomepageController::class, 'addbanner'])
       ->name('homepage.addbanner');

Route::get('/homepage/{project}/addvideo', [App\Http\Controllers\HomepageController::class, 'addvideo'])
       ->name('homepage.addvideo');

Route::get('/homepage/{project}/addannounce', [App\Http\Controllers\HomepageController::class, 'addannounce'])
       ->name('homepage.addannounce');

Route::get('/homepage/{id}/{position}/addadvertisting', [App\Http\Controllers\HomepageController::class, 'addadvertisting'])
       ->name('homepage.addadvertisting');

Route::get('/homepage/{project}/addinformations', [App\Http\Controllers\HomepageController::class, 'addinformations'])
       ->name('homepage.addinformations');

Route::get('/homepage/{project}/addhelp', [App\Http\Controllers\HomepageController::class, 'addhelp'])
       ->name('homepage.addhelp');

Route::get('/homepage/{project}/addmore', [App\Http\Controllers\HomepageController::class, 'addmore'])
       ->name('homepage.addmore');

Route::get('/homepage/{project}/addmarquee', [App\Http\Controllers\HomepageController::class, 'addmarquee'])
       ->name('homepage.addmarquee');

Route::resource('homepage', HomepageController::class);

Route::post('/logos/{id}', 'App\Http\Controllers\LogoController@newstore')->name('logos.newstore');

Route::resource('logos', LogoController::class);

Route::post('/banners/{id}', 'App\Http\Controllers\BannerController@newstore')->name('banners.newstore');

Route::resource('banners', BannerController::class);

Route::post('/advertistings/{id}/{position}', 'App\Http\Controllers\AdvertistingController@newstore')
       ->name('advertistings.newstore');

Route::resource('advertistings', AdvertistingController::class);

Route::post('/videos/{id}', 'App\Http\Controllers\VideoController@newstore')->name('videos.newstore');

Route::resource('videos', VideoController::class);

Route::post('/announces/{id}', 'App\Http\Controllers\AnnounceController@newstore')->name('announces.newstore');

Route::resource('announces', AnnounceController::class);

Route::post('/infos/{id}', 'App\Http\Controllers\InfoController@newstore')->name('infos.newstore');

Route::resource('infos', InfoController::class);

Route::post('/helps/{id}', 'App\Http\Controllers\HelpController@newstore')->name('helps.newstore');

Route::resource('helps', HelpController::class);

Route::post('/mores/{id}', 'App\Http\Controllers\MoreController@newstore')->name('mores.newstore');

Route::resource('mores', MoreController::class);

Route::post('/marquees/{id}', 'App\Http\Controllers\MarqueeController@newstore')->name('marquees.newstore');

Route::resource('marquees', MarqueeController::class);

Route::get('/admin/profile', [
    'as' => 'profile', 'uses' => 'App\Http\Controllers\AdminController@showProfile'
]);

Route::get('/upload-file', [FileUpload::class, 'createForm']);

Route::post('/upload-file', [FileUpload::class, 'fileUpload'])->name('fileUpload');


