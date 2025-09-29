<?php

namespace App\Http\Controllers\Api;

use App\Helper\ApiResponse;
use App\Http\Controllers\Controller;
use App\Models\Contract;
use App\Http\Requests\StoreContractRequest;
use App\Http\Requests\UpdateContractRequest;
use App\Http\Resources\ContractResource;

class ContractController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $contracts = Contract::with(['contractType', 'status'])->get();

        if (count($contracts) > 0) {
            return ApiResponse::reponseFn(200, "conract retrived successfully.", ContractResource::collection($contracts));
        }
        return ApiResponse::reponseFn(200, " no conract found.", $contracts);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreContractRequest $request)
    {
        $data = $request->validated();
        $created = Contract::create($data);
        if ($created) {
            return ApiResponse::reponseFn(201, "contract created successfully", $data);
        }
        return ApiResponse::reponseFn(200, "contract not created ", []);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $data = Contract::with(['contractType', 'status'])->find($id);
        if (!$data)
            return ApiResponse::reponseFn(200, "Contract not found.", []);
        else
            return ApiResponse::reponseFn(200, "Contract found successfully.", new ContractResource($data));
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateContractRequest $request, $id)
    {
        $data = Contract::find($id);
        if (!$data) {
            return ApiResponse::reponseFn(200, "Contract not found.", []);
        }
        $validated = $request->validated();
        $updated = $data->update($validated);
        if ($updated) {
            return ApiResponse::reponseFn(200, "Contract updated successfully.", new ContractResource($data));
        }
        return ApiResponse::reponseFn(200, "Contract not updated.", []);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $data = Contract::find($id);
        if (!$data) {
            return ApiResponse::reponseFn(200, "Contract not found.", []);
        }
        $deleted = $data->delete();
        if ($deleted) {
            return ApiResponse::reponseFn(200, "Contract deleted successfully.", []);
        }
        return ApiResponse::reponseFn(200, "Contract not deleted .", new ContractResource($data));
    }
}
