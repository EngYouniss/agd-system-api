<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use App\Models\AttachmentType;
use App\Http\Resources\AttachmentTypeResource;
use App\Helper\ApiResponse;
use App\Http\Requests\StoreAttachmentTypeRequest ;
use App\Http\Requests\UpdateAttachmentTypeRequest ;

class AttachmentTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = AttachmentType::query()->latest()->get();

        if ($data->count() > 0) {
            return ApiResponse::reponseFn(200, "List of Attachment Types retrieved successfully.", AttachmentTypeResource::collection($data));
        }

        return ApiResponse::reponseFn(200, "No Attachment Type records found.", []);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreAttachmentTypeRequest $request)
    {
        $validated = $request->validated();
        $created = AttachmentType::create($validated);

        if ($created) {
            return ApiResponse::reponseFn(201, "New Attachment Type created successfully.", new AttachmentTypeResource($created));
        }

        return ApiResponse::reponseFn(400, "Failed to create Attachment Type.", []);
    }

    /**
     * Display the specified resource.
     */
    public function show(AttachmentType $attachmentType)
    {
        if (!$attachmentType) {
            return ApiResponse::reponseFn(404, "Attachment Type not found.", []);
        }

        return ApiResponse::reponseFn(200, "Attachment Type details retrieved successfully.", new AttachmentTypeResource($attachmentType));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateAttachmentTypeRequest $request, AttachmentType $attachmentType)
    {
        if (!$attachmentType) {
            return ApiResponse::reponseFn(404, "Attachment Type not found.", []);
        }

        $updated = $attachmentType->update($request->validated());

        if ($updated) {
            return ApiResponse::reponseFn(200, "Attachment Type updated successfully.", new AttachmentTypeResource($attachmentType));
        }

        return ApiResponse::reponseFn(400, "Failed to update Attachment Type.", []);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(AttachmentType $attachmentType)
    {
        if (!$attachmentType) {
            return ApiResponse::reponseFn(404, "Attachment Type not found.", []);
        }

        $deleted = $attachmentType->delete();

        if ($deleted) {
            return ApiResponse::reponseFn(200, "Attachment Type deleted successfully.", []);
        }

        return ApiResponse::reponseFn(400, "Failed to delete Attachment Type.", new AttachmentTypeResource($attachmentType));
    }
}
