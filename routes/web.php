<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\RFIDController;
use App\Http\Controllers\ScanController;
use App\Http\Controllers\DroneController;
use App\Http\Controllers\Auth\AuthController;
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
    return view('auth.login');
});

Route::get('login', [AuthController::class, 'index'])->name('login');
Route::post('post-login', [AuthController::class, 'postLogin'])->name('login.post'); 
Route::get('registration', [AuthController::class, 'registration'])->name('register');
Route::post('post-registration', [AuthController::class, 'postRegistration'])->name('register.post'); 
Route::get('logout', [AuthController::class, 'logout'])->name('logout');
Route::get('dashboard', [AuthController::class, 'dashboard']); 


Route::get('inventory', [ItemController::class, 'inventory']);

Route::get('checkin', [ItemController::class, 'checkin']);
Route::post('postAddItem', [ItemController::class, 'postAddItem'])->name('addItem.post'); 

Route::get('viewitem\{id}', [ItemController::class, 'viewitem'])->name('viewitem');
Route::post('edititem', [ItemController::class, 'edititem']);
Route::post('checkoutitem', [ItemController::class, 'checkoutitem']);
Route::get('itempdf\{id}',  [ItemController::class, 'itempdf'])->name('itempdf');



Route::get('checkout', [ItemController::class, 'checkout']);
Route::get('viewcheckout\{id}', [ItemController::class, 'viewcheckout'])->name('viewcheckout');
Route::post('recheckinitem', [ItemController::class, 'recheckinitem']);
Route::post('deleteitem', [ItemController::class, 'deleteitem']);


Route::get('scaninventory', [ScanController::class, 'scaninventory']);
Route::get('scanresult', [ScanController::class, 'scanresult']);
Route::get('resetitemtatus', [ScanController::class, 'resetitemtatus']);

Route::get('setfound\{id}', [ScanController::class, 'setfound'])->name('setfound');
Route::get('setlost\{id}', [ScanController::class, 'setlost'])->name('setlost');

Route::get('dronecontrol',[DroneController::class,'dronecontrol']);
Route::post('saveresult',[DroneController::class,'saveResults'])->name('saveresult')->middleware('web');
Route::get('flightreview', [DroneController::class, 'flightReview'])->name('flightreview');
Route::get('viewmission\{id}', [DroneController::class, 'showMission'])->name('viewmission');

Route::post('connectrfid',[RFIDController::class,'connectRFID']);