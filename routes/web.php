<?php

/* DONOT CHANGE ORDER */
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Samples\SampleController;
use App\Http\Controllers\Landings\LandingPageController;
use App\Http\Controllers\Setups\ConfigurationController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\UserPanels\PanelController;



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


    Route::get('/', [LandingPageController::class, 'index'])->name('landingpage');                          // CHANGE IT LATER (IF NEDDED)



    //////////// SAMPLES-PAGE
    Route::get('/viewport', [SampleController::class, 'myviewport'])->name('showMyViewport');
    Route::get('/vp', [SampleController::class, 'myviewport'])->name('showMyViewport');



    //////////// TEMPLATE-PAGE
    Route::get('/doc', [ConfigurationController::class, 'showTemplatePage']);
    Route::get('/docs', [ConfigurationController::class, 'showTemplatePage']);




    //////////// LANDING-PAGE
    Route::get('/landing-page', [LandingPageController::class, 'index'])->name('landingpage');




    //////////// AUTH: LOGIN & RESET-PASS & REGISTER
    Route::get('/login', [LoginController::class, 'index'])->name('loginpage');
    Route::get('/forgot', [LoginController::class, 'forgotPassword'])->name('forgotpasspage');
    Route::get('/register', [RegisterController::class, 'index'])->name('registerpage');




    //////////// USERPANEL: DASHBOARD DKK
    Route::get('/dashboard', [PanelController::class, 'index'])->name('dashboardpage');
    Route::get('/myprofile', [PanelController::class, 'myprofile'])->name('myprofilepage');
    Route::get('/logout', [PanelController::class, 'logout'])->name('logoutredirect');
    Route::get('/m-inst', [PanelController::class, 'manage_institutions'])->name('m-institutions');
    Route::get('/m-mark', [PanelController::class, 'manage_markings'])->name('m-markings');
    Route::get('/m-userlevel', [PanelController::class, 'manage_user_levels'])->name('m-userlevels');
    Route::get('/m-userlist', [PanelController::class, 'manage_user_list'])->name('m-userlist');


}



