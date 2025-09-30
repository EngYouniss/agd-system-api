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
        $data = $request->validated();
        $created = ContractStatus::create($data);
        if ($created) {
            return ApiResponse::reponseFn(201, "status created successfully", $data);
        }
        return ApiResponse::reponseFn(200, "status not created ", []);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $data = ContractStatus::find($id);
        if (!$data)
            return ApiResponse::reponseFn(200, "status not found.", []);
        else
            return ApiResponse::reponseFn(200, "status found successfully.", new ContractStatusResource($data));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateContractStatusRequest $request, $id)
    {
        $data = ContractStatus::find($id);
        if (!$data) {
            return ApiResponse::reponseFn(200, "status not found.", []);
        }
        $validated = $request->validated();
        $updated = $data->update($validated);
        if ($updated) {
            return ApiResponse::reponseFn(200, "status updated successfully.", new ContractStatusResource($data));
        }
        return ApiResponse::reponseFn(200, "status not updated.", []);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $data = ContractStatus::find($id);
        if (!$data) {
            return ApiResponse::reponseFn(200, "status not found.", []);
        }
        $deleted = $data->delete();
        if ($deleted) {
            return ApiResponse::reponseFn(200, "status deleted successfully.", []);
        }
        return ApiResponse::reponseFn(200, "status not deleted .", new ContractStatusResource($data));
    }
}
