<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use App\Models\Governorate;
use App\Http\Resources\GovernorateResource;
use App\Http\Requests\StoreGovernorateRequest;



use App\Http\Requests\UpdateGovernorateRequest;
use App\Helper\ApiResponse;

class GovernorateController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Governorate::query()->latest()->get();

        if ($data->count() > 0) {
            return ApiResponse::reponseFn(200, "List of Governorates retrieved successfully.", GovernorateResource::collection($data));
        }

        return ApiResponse::reponseFn(200, "No Governorate records found.", []);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreGovernorateRequest $request)
    {
        $validated = $request->validated();
        $created = Governorate::create($validated);

        if ($created) {
            return ApiResponse::reponseFn(201, "New Governorate created successfully.", new GovernorateResource($created));
        }

        return ApiResponse::reponseFn(400, "Failed to create Governorate.", []);
    }

    /**
     * Display the specified resource.
     */
    public function show(Governorate $governorate)
    {
        if (!$governorate) {
            return ApiResponse::reponseFn(404, "Governorate not found.", []);
        }

        return ApiResponse::reponseFn(200, "Governorate details retrieved successfully.", new GovernorateResource($governorate));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateGovernorateRequest $request, Governorate $governorate)
    {
        if (!$governorate) {
            return ApiResponse::reponseFn(404, "Governorate not found.", []);
        }

        $updated = $governorate->update($request->validated());

        if ($updated) {
            return ApiResponse::reponseFn(200, "Governorate updated successfully.", new GovernorateResource($governorate));
        }

        return ApiResponse::reponseFn(400, "Failed to update Governorate.", []);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Governorate $governorate)
    {
        if (!$governorate) {
            return ApiResponse::reponseFn(404, "Governorate not found.", []);
        }

        $deleted = $governorate->delete();

        if ($deleted) {
            return ApiResponse::reponseFn(200, "Governorate deleted successfully.", []);
        }

        return ApiResponse::reponseFn(400, "Failed to delete Governorate.", new GovernorateResource($governorate));
    }
}
