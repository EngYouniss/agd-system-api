<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use App\Models\DocumentType;
use App\Http\Resources\DocumentTypeResource;
use App\Http\Requests\StoreDocumentTypeRequest;
use App\Http\Requests\UpdateDocumentTypeRequest;
use App\Helper\ApiResponse;

class DocumentTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = DocumentType::query()->latest()->get();

        if ($data->count() > 0) {
            return ApiResponse::reponseFn(200, "List of DocumentTypes retrieved successfully.", DocumentTypeResource::collection($data));
        }

        return ApiResponse::reponseFn(200, "No DocumentType records found.", []);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreDocumentTypeRequest $request)
    {
        $validated = $request->validated();
        $created = DocumentType::create($validated);

        if ($created) {
            return ApiResponse::reponseFn(201, "New DocumentType created successfully.", new DocumentTypeResource($created));
        }

        return ApiResponse::reponseFn(400, "Failed to create DocumentType.", []);
    }

    /**
     * Display the specified resource.
     */
    public function show(DocumentType $documentType)
    {
        if (!$documentType) {
            return ApiResponse::reponseFn(404, "DocumentType not found.", []);
        }

        return ApiResponse::reponseFn(200, "DocumentType details retrieved successfully.", new DocumentTypeResource($documentType));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateDocumentTypeRequest $request, DocumentType $documentType)
    {
        if (!$documentType) {
            return ApiResponse::reponseFn(404, "DocumentType not found.", []);
        }

        $updated = $documentType->update($request->validated());

        if ($updated) {
            return ApiResponse::reponseFn(200, "DocumentType updated successfully.", new DocumentTypeResource($documentType));
        }

        return ApiResponse::reponseFn(400, "Failed to update DocumentType.", []);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(DocumentType $documentType)
    {
        if (!$documentType) {
            return ApiResponse::reponseFn(404, "DocumentType not found.", []);
        }

        $deleted = $documentType->delete();

        if ($deleted) {
            return ApiResponse::reponseFn(200, "DocumentType deleted successfully.", []);
        }

        return ApiResponse::reponseFn(400, "Failed to delete DocumentType.", new DocumentTypeResource($documentType));
    }
}
