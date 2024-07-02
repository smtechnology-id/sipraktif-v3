<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\KaderController;

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

Route::get('/generate', function(){
    \Illuminate\Support\Facades\Artisan::call('storage:link');
    echo 'ok';
 });
 
Route::get('/', [AuthController::class, 'index'])->name('index');
Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/loginPost', [AuthController::class, 'loginPost'])->name('loginPost');

Route::get('/register', [AuthController::class, 'register'])->name('register');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/dataPerkara/{id}', [AuthController::class, 'dataPerkara'])->name('dataPerkara');
Route::get('/detailPerkara/{slug}', [AuthController::class, 'detailPerkara'])->name('detailPerkara');

Route::get('/tentang-restorative-justice', [AuthController::class, 'tentangRj'])->name('tentangRj');

Route::group(['middleware' => 'Admin'], function () {
    Route::get('/admin', [AdminController::class, 'index'])->name('admin.dashboard');
    Route::get('/admin/kasus', [AdminController::class, 'kasus'])->name('admin.kasus');

    Route::get('/admin/divisi', [AdminController::class, 'divisi'])->name('admin.divisi');
    Route::post('/admin/addDivision', [AdminController::class, 'addDivision'])->name('admin.addDivision');
    Route::post('/admin/updateDivision', [AdminController::class, 'updateDivision'])->name('admin.updateDivision');
    Route::get('/admin/delete-division/{id}', [AdminController::class, 'deleteDivision'])->name('admin.deleteDivisi');
    
    Route::get('/admin/user', [AdminController::class, 'user'])->name('admin.user');
    Route::post('/admin/add-user', [AdminController::class, 'addUser'])->name('admin.addUser');
    Route::post('/admin/update-user/{id}', [AdminController::class, 'updateUser'])->name('admin.updateUser');
    Route::get('/admin/delete-user/{id}', [AdminController::class, 'deleteUser'])->name('admin.deleteUser');
});

Route::group(['middleware' => 'user'], function () {
    Route::get('/user', [UserController::class, 'index'])->name('user.dashboard');
    Route::get('/user/kasus', [UserController::class, 'kasus'])->name('user.kasus');
    Route::get('/user/tambah-kasus', [UserController::class, 'addKasus'])->name('user.addKasus');
    Route::post('/user/storeKasus', [UserController::class, 'storeKasus'])->name('user.storeKasus');
    Route::get('/user/updateKasus/{id}', [UserController::class, 'updateKasus'])->name('user.updateKasus');
    Route::post('/user/updateKasusPost', [UserController::class, 'updateKasusPost'])->name('user.updateKasusPost');
    Route::get('/user/deleteKasus/{id}', [UserController::class, 'deleteKasus'])->name('user.deleteKasus');
});
