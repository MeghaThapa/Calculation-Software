<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\StaffController;

//Public Routes
Route::post('/user/login',[UserController::class,'login']) ->name('userLogin');
Route::post('/user/register',[UserController::class,'register']) ->name('userRegister');

Route::group(['middleware' => ['auth:sanctum']], function () {
// User routes
    Route::get('/user/{id}',[UserController::class,'userDetail']);
    Route::get('/users/userList',[UserController::class,'userList']);
    Route::post('/user/add',[UserController::class,'addUser']);
    Route::get('/user',[UserController::class,'index']);
    Route::get('/user/edit/{id}',[UserController::class,'userEdit']);
    Route::post('/user/update/{id}',[UserController::class,'update']);
    Route::delete('/user/delete/{id}',[UserController::class,'delete']);

    // staff routes
    Route::post('/staff/create',[StaffController::class,'create']);
    Route::get('/staff/index',[StaffController::class,'index']);
    Route::get('/staffEdit/{id}',[StaffController::class,'editStaff']);
    Route::post('/editedStaff/save/{id}',[StaffController::class,'editStaffSave']);
    Route::post('/editedStaff/toggleEdit/{id}',[StaffController::class,'toggleEdit']);
    Route::delete('/Staff/delete/{id}',[StaffController::class,'deleteStaff']);



});
