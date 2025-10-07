<?php

namespace App\Http\Controllers\Api;

use App\Models\Document;
use App\Http\Resources\{{ modelName }}Resource;
use App\Http\Requests\StoreDocumentRequest;



use App\Http\Requests\ UpdateDocumentRequest;
use App\Helper\ApiResponse;

class DocumentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Document::query()->latest()->get();

        if ($data->count() > 0) {
            return ApiResponse::reponseFn(200, "List of {{ modelName }}s retrieved successfully.", {{ modelName }}Resource::collection($data));
        }

        return ApiResponse::reponseFn(200, "No {{ modelName }} records found.", []);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreDocumentRequest $request)
    {
        $validated = $request->validated();
        $created = Document::create($validated);

        if ($created) {
            return ApiResponse::reponseFn(201, "New {{ modelName }} created successfully.", new {{ modelName }}Resource($created));
        }

        return ApiResponse::reponseFn(400, "Failed to create {{ modelName }}.", []);
    }

    /**
     * Display the specified resource.
     */
    public function show(Document $document)
    {
        if (!$document) {
            return ApiResponse::reponseFn(404, "{{ modelName }} not found.", []);
        }

        return ApiResponse::reponseFn(200, "{{ modelName }} details retrieved successfully.", new {{ modelName }}Resource($document));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateDocumentRequest $request, Document $document)
    {
        if (!$document) {
            return ApiResponse::reponseFn(404, "{{ modelName }} not found.", []);
        }

        $updated = $document->update($request->validated());

        if ($updated) {
            return ApiResponse::reponseFn(200, "{{ modelName }} updated successfully.", new {{ modelName }}Resource($document));
        }

        return ApiResponse::reponseFn(400, "Failed to update {{ modelName }}.", []);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Document $document)
    {
        if (!$document) {
            return ApiResponse::reponseFn(404, "{{ modelName }} not found.", []);
        }

        $deleted = $document->delete();

        if ($deleted) {
            return ApiResponse::reponseFn(200, "{{ modelName }} deleted successfully.", []);
        }

        return ApiResponse::reponseFn(400, "Failed to delete {{ modelName }}.", new {{ modelName }}Resource($document));
    }
}
