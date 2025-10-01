<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use App\Models\Attachment;
use App\Http\Resources\AttachmentResource;

use App\Helper\ApiResponse;
use App\Http\Requests\StoreAttachmentRequest;
use App\Http\Requests\UpdateAttachmentRequest;

class AttachmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Attachment::query()->latest()->get();

        if ($data->count() > 0) {
            return ApiResponse::reponseFn(200, "List of Attachments retrieved successfully.",AttachmentResource::collection($data));
        }

        return ApiResponse::reponseFn(200, "No Attachment records found.", []);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreAttachmentRequest $request)
    {
        $validated = $request->validated();
        $created = Attachment::create($validated);

        if ($created) {
            return ApiResponse::reponseFn(201, "New Attachment created successfully.", new AttachmentResource($created));
        }

        return ApiResponse::reponseFn(400, "Failed to create Attachment.", []);
    }

    /**
     * Display the specified resource.
     */
    public function show(Attachment $attachment)
    {
        if (!$attachment) {
            return ApiResponse::reponseFn(404, "Attachment not found.", []);
        }

        return ApiResponse::reponseFn(200, "Attachment details retrieved successfully.", new AttachmentResource($attachment));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateAttachmentRequest $request, Attachment $attachment)
    {
        if (!$attachment) {
            return ApiResponse::reponseFn(404, "Attachment not found.", []);
        }

        $updated = $attachment->update($request->validated());

        if ($updated) {
            return ApiResponse::reponseFn(200, "Attachment updated successfully.", new AttachmentResource($attachment));
        }

        return ApiResponse::reponseFn(400, "Failed to update Attachment.", []);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Attachment $attachment)
    {
        if (!$attachment) {
            return ApiResponse::reponseFn(404, "Attachment not found.", []);
        }

        $deleted = $attachment->delete();

        if ($deleted) {
            return ApiResponse::reponseFn(200, "Attachment deleted successfully.", []);
        }

        return ApiResponse::reponseFn(400, "Failed to delete Attachment.", new AttachmentResource($attachment));
    }
}
