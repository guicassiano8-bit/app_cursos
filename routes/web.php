<?php

use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\CoursesController;
use App\Http\Controllers\ForgotPasswordController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LessonController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/',[HomeController::class,'index'])->name('home.index');
Route::get('/course',[CourseController::class,'index'])->name('course.index')->middleware('auth');
Route::get('/checkout',[CheckoutController::class,'index'])->name('checkout.index');
Route::get('/forgot-password',[ForgotPasswordController::class,'index'])->name('forgot-password.index');
Route::post('/forgot-password',[ForgotPasswordController::class,'store'])->name('forgot-password.store');
Route::get('/forgot-password/{token}',[ForgotPasswordController::class,'edit'])->name('password.reset');
Route::put('/forgot-password',[ForgotPasswordController::class,'update'])->name('forgot-password.update')->middleware('guest');
Route::get('/contact',[ContactController::class,'index'])->name('contact.index');

Route::get('/user/create',[UserController::class,'create'])->name('user.create')->middleware('guest');
Route::post('/user',[UserController::class,'store'])->name('user.store')->middleware('guest');

Route::get('/courses',[CoursesController::class,'index'])->name('courses.index');
Route::get('/lesson',[LessonController::class,'index'])->name('lesson.index');
Route::resource('/login',LoginController::class)->except('destroy');
Route::delete('/logout',[LoginController::class,'destroy'])->name('login.destroy');


Route::fallback(function(){
    return view('erro.404');
});