<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\AdminController; 
use App\Http\Controllers\AdminLTEController;
use App\Http\Controllers\AdminLTEStudentController;
use App\Http\Controllers\StudentApiController;

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

Route::get('/', function () {
    return view('welcome');
});
Route::group(['middleware' => 'login_auth'], function () {
    // Your existing routes
    Route::get('/student/create', [StudentController::class, 'create'])->name('student.create');
    Route::post('adminlte/student', [StudentController::class, 'store'])->name('admin.ltestudent.store');
    Route::get('/student', [StudentController::class, 'index'])->name('student.index');
    Route::get('/student/{student}', [StudentController::class, 'show'])->name('student.show');
    Route::get('/student/{student}/edit', [StudentController::class, 'edit'])->name('student.edit');
    Route::patch('/student/{student}', [StudentController::class, 'update'])->name('student.update');
    Route::delete('/student/{student}', [StudentController::class, 'destroy'])->name('student.destroy'); 
});

 // AdminLTEStudentController routes
 Route::get('/adminlte/student/create', [AdminLTEStudentController::class, 'create'])->name('adminlte.student.create');
 Route::post('/adminlte/student', [AdminLTEStudentController::class, 'store'])->name('adminlte.student.store');
 Route::get('/adminlte/student/index', [AdminLTEStudentController::class, 'index'])->name('adminlte.student.index');
 Route::get('/adminlte/student/{student}', [AdminLTEStudentController::class, 'show'])->name('adminlte.student.show');
 Route::get('/adminlte/student/{student}/edit', [AdminLTEStudentController::class, 'edit'])->name('adminlte.student.edit');
 Route::patch('/adminlte/student/{student}', [AdminLTEStudentController::class, 'update'])->name('adminlte.student.update');
 Route::delete('/adminlte/student/{student}', [AdminLTEStudentController::class, 'destroy'])->name('adminlte.student.destroy');

Route::get('/login', [AdminController::class,'index'])->name('login.index');
Route::get('/logout', [AdminController::class,'logout'])->name('login.logout');
Route::post('/login', [AdminController::class,'process'])->name('login.process');

// Get API
Route::post('student', [StudentApiController::class,'store']);
Route::get('student', [StudentApiController::class,'index']);
Route::put('student/{id}', [StudentApiController::class,'update']);
Route::delete('student/{id}', [StudentApiController::class,'destroy']);