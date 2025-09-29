<?php

namespace App\Http\Controllers\Api;

use App\Helper\ApiResponse;
use App\Http\Controllers\Controller;
use App\Models\ContractStatus;
use App\Http\Requests\StoreContractStatusRequest;
use App\Http\Requests\UpdateContractStatusRequest;
use App\Http\Resources\ContractStatusResource;

class ContractStatusController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $contractStatuses = ContractStatus::get();
        if (count($contractStatuses) > 0) {
            return ApiResponse::reponseFn(200, "Statuses retrieved successfully.", ContractStatusResource::collection($contractStatuses));
        }
        return ApiResponse::reponseFn(200, " There is no Statuses .", ContractStatusResource::collection($contractStatuses));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreContractStatusRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(ContractStatus $contractStatus)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateContractStatusRequest $request, ContractStatus $contractStatus)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ContractStatus $contractStatus)
    {
        //
    }
}
