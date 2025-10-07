<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use App\Models\Person;
use App\Http\Resources\PersonResource;
use App\Http\Requests\StorePersonRequest;
use App\Http\Requests\UpdatePersonRequest;
use App\Helper\ApiResponse;

class PersonController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Person::query()->latest()->get();

        if ($data->count() > 0) {
            return ApiResponse::reponseFn(200, "List of Persons retrieved successfully.", PersonResource::collection($data));
        }

        return ApiResponse::reponseFn(200, "No Person records found.", []);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePersonRequest $request)
    {
        $validated = $request->validated();
        $created = Person::create($validated);

        if ($created) {
            return ApiResponse::reponseFn(201, "New Person created successfully.", new PersonResource($created));
        }

        return ApiResponse::reponseFn(400, "Failed to create Person.", []);
    }

    /**
     * Display the specified resource.
     */
    public function show(Person $person)
    {
        if (!$person) {
            return ApiResponse::reponseFn(404, "Person not found.", []);
        }

        return ApiResponse::reponseFn(200, "Person details retrieved successfully.", new PersonResource($person));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePersonRequest $request, Person $person)
    {
        if (!$person) {
            return ApiResponse::reponseFn(404, "Person not found.", []);
        }

        $updated = $person->update($request->validated());

        if ($updated) {
            return ApiResponse::reponseFn(200, "Person updated successfully.", new PersonResource($person));
        }

        return ApiResponse::reponseFn(400, "Failed to update Person.", []);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Person $person)
    {
        if (!$person) {
            return ApiResponse::reponseFn(404, "Person not found.", []);
        }

        $deleted = $person->delete();

        if ($deleted) {
            return ApiResponse::reponseFn(200, "Person deleted successfully.", []);
        }

        return ApiResponse::reponseFn(400, "Failed to delete Person.", new PersonResource($person));
    }
}
