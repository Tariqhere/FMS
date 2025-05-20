<?php


use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\OfficeController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\DesiginationController;
use App\Http\Controllers\DispatchController;
use App\Http\Controllers\FlagController;
use App\Http\Controllers\FolderController;


// Route::get('/', function () {
//     return view('frontend.auth.index');
// });

Route::get('/', function () {
    return view('auth.login');
})->name('login');


Route::middleware('auth')->prefix('backend')->group(function(){

Route::resources([


    'department'      => DepartmentController::class,
    'user'           =>  UserController::class,
    'desigination'    => DesiginationController::class,
    'office'         => OfficeController::class,
    'flag'           =>FlagController::class,
    'folder'         =>FolderController::class,
    'dispatch'       =>DispatchController::class,

 ]);

                         //department//
 Route::get('/department/delete/{id}', [DepartmentController::class, 'delete'])->name('department.delete');
                           //user//
Route::get('/user/delete/{id}', [UserController::class, 'delete'])->name('user.delete');
                        //desigination//
Route::get('/desigination/delete/{id}', [DesiginationController::class, 'delete'])->name('desigination.delete');
                        //office//
Route::get('/office/delete/{id}', [OfficeController::class, 'delete'])->name('office.delete');
                         //flag//
 Route::get('/flag/delete/{id}', [FlagController::class, 'delete'])->name('flag.delete');
                         //folder//
 Route::get('/folder/delete/{id}', [FolderController::class, 'delete'])->name('folder.delete');
                          //dispatch//
 Route::get('/dispatch/delete/{id}', [DispatchController::class, 'delete'])->name('dispatch.delete');

});
Auth::routes();

Route::get('/dashboard', [App\Http\Controllers\HomeController::class, 'index'])->name('dashboard');

//scopes
Route::get('/get/dispatch/pending', [App\Http\Controllers\DispatchController::class, 'pendingDispatch'])->name('get.dispatch.pending');


