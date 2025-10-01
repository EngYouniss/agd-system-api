<?php

use App\Http\Controllers\Admin\UsersController;
use App\Http\Controllers\Api\AttachmentTypeController;
use App\Http\Controllers\Api\ContractController;
use App\Http\Controllers\Api\ContractStatusController;
use App\Http\Controllers\Api\ContractTypeController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// Route::post('/login',[UsersController::class,'login']);

##---------------------- Contracts Module -------------------##

Route::apiResource('all-contracts',ContractController::class);

##---------------------- Contracts Types Module -------------------##

Route::apiResource('contracts/types',ContractTypeController::class);

##---------------------- Contracts statuses Module -------------------##

Route::apiResource('contracts/statuses',ContractStatusController::class);

##---------------------- Attachments Types Module -------------------##

Route::apiResource('contracts/attachments',AttachmentTypeController::class);
