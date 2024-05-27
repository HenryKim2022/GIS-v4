<?php

/* DONOT CHANGE ORDER */

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Samples\SampleController;
use App\Http\Controllers\Landings\LandingPageController;
use App\Http\Controllers\Setups\ConfigurationController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\UserPanels\PanelController;
use App\Http\Controllers\Marks\MarkController;
use App\Http\Controllers\Categories\CategoryController;
use App\Http\Controllers\Users\UserController;



/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });
// // Add other routes as needed
// Route::get('/', function () {
//     return view('welcome');
// })->name('home');
//////////////////////////////////////////////////////////////////////////////////////////////////////////////


// // // // SETUPS: ENV CONFIG
Route::get('/configure', [ConfigurationController::class, 'showConfigurationPage'])->name('configure');     // FORM VIEWER
Route::post('/configure', [ConfigurationController::class, 'saveConfiguration'])->name('configure.save');   // CONFIG FORM SAVER
if (env('APP_INSTALL', false)) {    // Not False
    Route::redirect('/', '/configure');
    Route::redirect('/{any}', '/configure');
} else {
    Route::get('/configure', function () {
        return redirect('/');
    });


    Route::get('/', [LandingPageController::class, 'index'])->name('landing.page');                          // CHANGE IT LATER (IF NEDDED)



    //////////// SAMPLES-PAGE
    Route::get('/viewport', [SampleController::class, 'myviewport'])->name('showMyViewport');
    Route::get('/vp', [SampleController::class, 'myviewport'])->name('showMyViewport');



    //////////// TEMPLATE-PAGE
    Route::get('/doc', [ConfigurationController::class, 'showTemplatePage']);
    Route::get('/docs', [ConfigurationController::class, 'showTemplatePage']);




    //////////// LANDING-PAGE
    Route::get('/landing-page', [LandingPageController::class, 'index'])->name('landing.page');




    //////////// AUTH: LOGIN & RESET-PASS & REGISTER
    Route::get('/login', [LoginController::class, 'index'])->name('login');
    Route::get('/login', [LoginController::class, 'index'])->name('login.show');
    Route::post('/login', [LoginController::class, 'doLogin'])->name('login.submit');
    Route::get('/forgot', [LoginController::class, 'forgotPassword'])->name('forgotpasspage');
    Route::get('/register', [RegisterController::class, 'index'])->name('registerpage');



    //////////// USERPANEL: DASHBOARD DKK
    Route::get('/dashboard', [PanelController::class, 'index'])->name('dashboard.page');
    Route::get('/myprofile', [PanelController::class, 'myprofile'])->name('myprofile.page');
    Route::get('/logout', [PanelController::class, 'logout'])->name('logout.redirect');
    Route::get('/m-inst', [PanelController::class, 'manage_institutions'])->name('m-institutions');


    Route::get('/m-mark', [MarkController::class, 'index'])->name('m-markings.index');
    // Route::post('/m-mark', [MarkController::class, 'add_marking'])->name('m-markings.post');
    Route::post('/m-mark/add-mark', [MarkController::class, 'add_marking'])->name('m-markings.post');
    Route::post('/m-mark/get-mark', [MarkController::class, 'get_marking'])->name('m-mark-data.get');
    Route::post('/m-mark/edit-mark', [MarkController::class, 'edit_marking'])->name('m-mark-data.edit');
    Route::post('/m-mark/update-mark', [MarkController::class, 'update_marking'])->name('m-mark-data.update');
    Route::post('/m-mark/delete-mark', [MarkController::class, 'delete_marking'])->name('m-mark-data.delete');
    Route::post('/m-mark/reset', [MarkController::class, 'reset_marking'])->name('m-mark-data.reset');


    Route::get('/m-categories', [CategoryController::class, 'index'])->name('m-categories.index');
    Route::post('/m-categories/add-cat', [CategoryController::class, 'add_categories'])->name('m-categories.post');
    Route::post('/m-categories/get-cat', [CategoryController::class, 'get_categories'])->name('m-cat-data.get');
    Route::post('/m-categories/edit-cat', [CategoryController::class, 'edit_categories'])->name('m-cat-data.edit');
    Route::post('/m-categories/update-cat', [CategoryController::class, 'update_categories'])->name('m-cat-data.update');
    Route::post('/m-categories/delete-cat', [CategoryController::class, 'delete_categories'])->name('m-cat-data.delete');
    Route::post('/m-categories/reset', [CategoryController::class, 'reset_categories'])->name('m-cat-data.reset');



    Route::get('/m-userlist', [UserController::class, 'index'])->name('m-ul.index');
    Route::post('/m-userlist/add-u', [UserController::class, 'add_user'])->name('m-ul.post');
    Route::post('/m-userlist/get-u', [UserController::class, 'get_user'])->name('m-ul-data.get');
    Route::post('/m-userlist/edit-u', [UserController::class, 'edit_user'])->name('m-ul-data.edit');
    Route::post('/m-userlist/update-u', [UserController::class, 'update_user'])->name('m-ul-data.update');
    Route::post('/m-userlist/delete-u', [UserController::class, 'delete_user'])->name('m-ul-data.delete');
    Route::post('/m-userlist/reset', [UserController::class, 'reset_user'])->name('m-ul-data.reset');

}
