<?php

/* DONOT CHANGE ORDER */

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Samples\SampleController;
use App\Http\Controllers\Sessions\SessionController;
use App\Http\Controllers\Developers\DeveloperController;
use App\Http\Controllers\Landings\LandingPageController;
use App\Http\Controllers\Setups\ConfigurationController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\UserPanels\PanelController;
use App\Http\Controllers\Marks\MarkController;
use App\Http\Controllers\Categories\CategoryController;
use App\Http\Controllers\Users\UserController;
use App\Http\Controllers\Institutions\InstutionController;
use App\Http\Controllers\Images\ImageController;
use App\Http\Controllers\MarksAndInstitutions\MarksAndInstitutionController;





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
    Route::get('/landing-page/loadmark', [LandingPageController::class, 'load_marks_into_map'])->name('l-mark.landing.page');
    Route::get('/landing-page/modalviewmark', [LandingPageController::class, 'modalurlpage'])->name('l-modalviewmark.landing.page');



    Route::get('/csrf-token', function () {
        return response()->json(['token' => csrf_token()]);
    })->name('csrf.token');



    //////////// AUTH: LOGIN & RESET-PASS & REGISTER
    // Route::get('/login', [LoginController::class, 'index'])->name('login');
    // Route::get('/login', [LoginController::class, 'index'])->name('login.show');
    // Route::post('/login', [LoginController::class, 'doLogin'])->name('login.submit');
    // Route::get('/forgot', [LoginController::class, 'forgotPassword'])->name('forgotpasspage');
    // // Route::get('/register', [RegisterController::class, 'index'])->name('registerpage');


    // Route::controller(LoginController::class)->group(function(){
    //     // Route::get('/login', 'index')->name('login');
    //     Route::get('/login', 'index')->name('login.show');
    //     Route::post('/login', 'doLogin')->name('login.submit');
    // });


    Route::prefix('login')->name('login.')->group(function () {
        Route::get('/', [LoginController::class, 'index'])->name('show');
        Route::post('/', [LoginController::class, 'doLogin'])->name('submit');
    });
    Route::controller(RegisterController::class)->group(function(){
        Route::get('/register', 'index')->name('register.show');
        Route::post('/register', 'doRegister')->name('register.submit');
    });


    ////////// USERPANEL: DASHBOARD DKK
    // Route::get('/dashboard', [PanelController::class, 'index'])->name('dashboard.page');
    // Route::get('/logout', [PanelController::class, 'logout'])->name('logout.redirect');
    // Route::get('/myprofile', [PanelController::class, 'myprofile'])->name('myprofile.page');
    Route::controller(PanelController::class)->group(function(){
        Route::get('/dashboard', 'index')->name('dashboard.page');
        Route::get('/dashboard/load_chart', 'load_dashboard_chart')->name('dashboard.chart.load');
        Route::get('/logout', 'logout')->name('logout.redirect');
        Route::get('/myprofile', 'myprofile')->name('myprofile.page');
        Route::post('/myprofile/edit-img', 'edit_myprofile_img')->name('myprofile.img.edit');
        Route::post('/myprofile/edit-bio', 'edit_myprofile_bio')->name('myprofile.bio.edit');
        Route::post('/myprofile/edit-pass', 'edit_myprofile_pass')->name('myprofile.pass.edit');
    });


    // Route::middleware(['auth', 'user-access:guest'])->group(function(){
    //     Route::get('/dashboard', [LoginController::class, 'index'])->name('dashboard.page');
    //     Route::get('/logout', [PanelController::class, 'logout'])->name('logout.redirect');
    //     Route::get('/myprofile', [PanelController::class, 'myprofile'])->name('myprofile.page');
    //     Route::post('/myprofile/edit-img', [PanelController::class, 'edit_myprofile_img'])->name('myprofile.img.edit');
    //     Route::post('/myprofile/edit-bio', [PanelController::class, 'edit_myprofile_bio'])->name('myprofile.bio.edit');
    //     Route::post('/myprofile/edit-pass', [PanelController::class, 'edit_myprofile_pass'])->name('myprofile.pass.edit');
    // });

    // Route::middleware(['auth', 'user-access:institution'])->group(function(){
    //     Route::get('/dashboard', [PanelController::class, 'index'])->name('dashboard.page');
    //     Route::get('/logout', [PanelController::class, 'logout'])->name('logout.redirect');
    //     Route::get('/myprofile', [PanelController::class, 'myprofile'])->name('myprofile.page');
    //     Route::post('/myprofile/edit-img', [PanelController::class, 'edit_myprofile_img'])->name('myprofile.img.edit');
    //     Route::post('/myprofile/edit-bio', [PanelController::class, 'edit_myprofile_bio'])->name('myprofile.bio.edit');
    //     Route::post('/myprofile/edit-pass', [PanelController::class, 'edit_myprofile_pass'])->name('myprofile.pass.edit');
    // });





    Route::get('/one-time', [MarksAndInstitutionController::class, 'index'])->name('m-one-time-markings.index');
    Route::get('/one-time/loadone', [MarksAndInstitutionController::class, 'load_one_into_map'])->name('l-one.m-one.page');
    Route::post('/one-time/get-cat', [MarksAndInstitutionController::class, 'get_cats'])->name('m-one-data.cat.get');




    Route::get('/m-mark', [MarkController::class, 'index'])->name('m-markings.index');
    Route::get('/m-mark/loadmark', [MarkController::class, 'load_marks_into_map'])->name('l-mark.m-mark.page');
    Route::post('/m-mark/add-mark-maps', [MarkController::class, 'add_marking_from_maps'])->name('m-mark-maps-data.post');
    Route::post('/m-mark/edit-mark-maps', [MarkController::class, 'edit_marking_from_maps'])->name('m-mark-maps-data.edit');
    Route::post('/m-mark/delete-mark-maps', [MarkController::class, 'delete_marking_from_maps'])->name('m-mark-maps-data.delete');
    Route::post('/m-mark/add-mark', [MarkController::class, 'add_marking'])->name('m-markings.post');
    Route::post('/m-mark/edit-mark', [MarkController::class, 'edit_marking'])->name('m-mark-data.edit');
    Route::post('/m-mark/get-mark', [MarkController::class, 'get_marking'])->name('m-mark-data.get');
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


    Route::get('/m-inst', [InstutionController::class, 'index'])->name('m-inst.index');
    Route::post('/m-inst/add-inst', [InstutionController::class, 'add_inst'])->name('m-inst.post');
    Route::post('/m-inst/get-inst', [InstutionController::class, 'get_inst'])->name('m-inst-data.get');
    Route::post('/m-inst/edit-inst', [InstutionController::class, 'edit_inst'])->name('m-inst-data.edit');
    Route::post('/m-inst/update-inst', [InstutionController::class, 'update_inst'])->name('m-inst-data.update');
    Route::post('/m-inst/delete-inst', [InstutionController::class, 'delete_inst'])->name('m-inst-data.delete');
    Route::post('/m-inst/reset', [InstutionController::class, 'reset_inst'])->name('m-inst-data.reset');
    Route::post('/m-inst/load-select-list-addmodal', [InstutionController::class, 'load_select_list_for_addmodal'])->name('m-inst-get-selectlist-addm');
    Route::post('/m-inst/load-select-list-editmodal', [InstutionController::class, 'load_select_list_for_editmodal'])->name('m-inst-get-selectlist-editm');


    Route::get('/m-image', [ImageController::class, 'index'])->name('m-image.index');
    Route::post('/m-image/add-img', [ImageController::class, 'add_img'])->name('m-image.post');
    Route::post('/m-image/get-img', [ImageController::class, 'get_img'])->name('m-image-data.get');
    Route::post('/m-image/edit-img', [ImageController::class, 'edit_img'])->name('m-image-data.edit');
    Route::post('/m-image/update-img', [ImageController::class, 'update_img'])->name('m-image-data.update');
    Route::post('/m-image/delete-img', [ImageController::class, 'delete_img'])->name('m-image-data.delete');
    Route::post('/m-image/reset', [ImageController::class, 'reset_img'])->name('m-image-data.reset');
    Route::post('/m-image/load-select-list', [ImageController::class, 'load_select_list_for_modal'])->name('m-image-get.selectlist');


}
