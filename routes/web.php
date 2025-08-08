<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthenticationController;
use App\Http\Controllers\HomeController;

Route::get('/', function () {
    return view('welcome');
});

Route::group(['middleware' => "guest"], function() { 
    Route::get('/login', [AuthenticationController::class, 'login'])->name('login');   
    Route::post('/handle-login', [AuthenticationController::class, 'handleLogin'])->name('handle.login');   
    Route::get('/signup-step-one', [AuthenticationController::class, 'signupStepOne'])->name('signup.step.one');  
    Route::get('/signup-step-two', [AuthenticationController::class, 'signupStepTwo'])->name('signup.step.two');  
    Route::post('/signup-step-one', [AuthenticationController::class, 'createSignupStepOne'])->name('create.signup.step.one');  
    Route::post('/signup-step-two', [AuthenticationController::class, 'createSignupStepTwo'])->name('create.signup.step.two');  
});

Route::group(['middleware' => "auth"], function() { 
    Route::get('/', [HomeController::class, 'home'])->name('home');
    Route::get('/logout', [AuthenticationController::class, 'handleLogout'])->name('handle.logout');
});