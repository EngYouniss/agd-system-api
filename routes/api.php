<?php

use App\Http\Controllers\Admin\UsersController;
use App\Http\Controllers\Api\AttachmentController;
use App\Http\Controllers\Api\AttachmentTypeController;
use App\Http\Controllers\Api\ContractController;
use App\Http\Controllers\Api\ContractStatusController;
use App\Http\Controllers\Api\ContractTypeController;
use App\Http\Controllers\Api\CourtController;
use App\Http\Controllers\Api\DistrictController;
use App\Http\Controllers\Api\GovernorateController;
use App\Models\Court;
use App\Models\District;
use App\Models\Governorate;
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

Route::apiResource('contracts/attachments-types',AttachmentTypeController::class);

##---------------------- Attachments Module -------------------##

Route::apiResource('contracts/attachments',AttachmentController::class);


##---------------------- Attachments Module -------------------##

Route::apiResource('contracts/governorate',GovernorateController::class);

##---------------------- District Module -------------------##

Route::apiResource('contracts/district',DistrictController::class);


##---------------------- District Module -------------------##

Route::apiResource('contracts/court',CourtController::class);

