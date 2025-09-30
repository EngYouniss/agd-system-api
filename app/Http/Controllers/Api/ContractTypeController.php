<?php

namespace App\Http\Controllers\Api;

use App\Helper\ApiResponse;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreContractTypeRequest;
use App\Http\Requests\UpdateContractTypeRequest;
use App\Http\Resources\ContractTypeResource;
use App\Models\ContractType;
use Illuminate\Http\Request;

class ContractTypeController extends Controller
{
    public function index()
    {

        $contractTypes = ContractType::get();
        if (count($contractTypes) > 0) {
            return ApiResponse::reponseFn(200, ' types retrieved successfully', ContractTypeResource::collection($contractTypes));
        }
        return ApiResponse::reponseFn(200, ' There is no types', []);
    }

    public function store(StoreContractTypeRequest $request)
    {
        $data = $request->validated();
        $created = ContractType::create($data);
        if ($created) {
            return ApiResponse::reponseFn(201, "type created successfully", $data);
        }
        return ApiResponse::reponseFn(200, "type not created ", []);
    }


 /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $data = ContractType::find($id);
        if (!$data)
            return ApiResponse::reponseFn(200, "type not found.", []);
        else
            return ApiResponse::reponseFn(200, "type found successfully.", new ContractTypeResource($data));
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateContractTypeRequest $request, $id)
    {
        $data = ContractType::find($id);
        if (!$data) {
            return ApiResponse::reponseFn(200, "type not found.", []);
        }
        $validated = $request->validated();
        $updated = $data->update($validated);
        if ($updated) {
            return ApiResponse::reponseFn(200, "type updated successfully.", new ContractTypeResource($data));
        }
        return ApiResponse::reponseFn(200, "type not updated.", []);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $data = ContractType::find($id);
        if (!$data) {
            return ApiResponse::reponseFn(200, "type not found.", []);
        }
        $deleted = $data->delete();
        if ($deleted) {
            return ApiResponse::reponseFn(200, "type deleted successfully.", []);
        }
        return ApiResponse::reponseFn(200, "type not deleted .", new ContractTypeResource($data));
    }




}
