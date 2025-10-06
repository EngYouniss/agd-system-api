<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use App\Models\District;
use App\Http\Resources\DistrictResource;
use App\Http\Requests\StoreDistrictRequest;
use App\Http\Requests\UpdateDistrictRequest;
use App\Helper\ApiResponse;

class DistrictController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = District::query()->latest()->get();

        if ($data->count() > 0) {
            return ApiResponse::reponseFn(200, "List of Districts retrieved successfully.", DistrictResource::collection($data));
        }

        return ApiResponse::reponseFn(200, "No District records found.", []);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreDistrictRequest $request)
    {
        $validated = $request->validated();
        $created = District::create($validated);

        if ($created) {
            return ApiResponse::reponseFn(201, "New District created successfully.", new DistrictResource($created));
        }

        return ApiResponse::reponseFn(400, "Failed to create District.", []);
    }

    /**
     * Display the specified resource.
     */
    public function show(District $district)
    {
        if (!$district) {
            return ApiResponse::reponseFn(404, "District not found.", []);
        }

        return ApiResponse::reponseFn(200, "District details retrieved successfully.", new DistrictResource($district));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateDistrictRequest $request, District $district)
    {
        if (!$district) {
            return ApiResponse::reponseFn(404, "District not found.", []);
        }

        $updated = $district->update($request->validated());

        if ($updated) {
            return ApiResponse::reponseFn(200, "District updated successfully.", new DistrictResource($district));
        }

        return ApiResponse::reponseFn(400, "Failed to update District.", []);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(District $district)
    {
        if (!$district) {
            return ApiResponse::reponseFn(404, "District not found.", []);
        }

        $deleted = $district->delete();

        if ($deleted) {
            return ApiResponse::reponseFn(200, "District deleted successfully.", []);
        }

        return ApiResponse::reponseFn(400, "Failed to delete District.", new DistrictResource($district));
    }
}
