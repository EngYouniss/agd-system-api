<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use App\Models\Court;
use App\Http\Resources\CourtResource;
use App\Http\Requests\StoreCourtRequest;
use App\Http\Requests\UpdateCourtRequest;
use App\Helper\ApiResponse;

class CourtController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Court::query()->latest()->get();

        if ($data->count() > 0) {
            return ApiResponse::reponseFn(200, "List of Courts retrieved successfully.", CourtResource::collection($data));
        }

        return ApiResponse::reponseFn(200, "No Court records found.", []);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCourtRequest $request)
    {
        $validated = $request->validated();
        $created = Court::create($validated);

        if ($created) {
            return ApiResponse::reponseFn(201, "New Court created successfully.", new CourtResource($created));
        }

        return ApiResponse::reponseFn(400, "Failed to create Court.", []);
    }

    /**
     * Display the specified resource.
     */
    public function show(Court $court)
    {
        if (!$court) {
            return ApiResponse::reponseFn(404, "Court not found.", []);
        }

        return ApiResponse::reponseFn(200, "Court details retrieved successfully.", new CourtResource($court));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCourtRequest $request, Court $court)
    {
        if (!$court) {
            return ApiResponse::reponseFn(404, "Court not found.", []);
        }

        $updated = $court->update($request->validated());

        if ($updated) {
            return ApiResponse::reponseFn(200, "Court updated successfully.", new CourtResource($court));
        }

        return ApiResponse::reponseFn(400, "Failed to update Court.", []);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Court $court)
    {
        if (!$court) {
            return ApiResponse::reponseFn(404, "Court not found.", []);
        }

        $deleted = $court->delete();

        if ($deleted) {
            return ApiResponse::reponseFn(200, "Court deleted successfully.", []);
        }

        return ApiResponse::reponseFn(400, "Failed to delete Court.", new CourtResource($court));
    }
}
