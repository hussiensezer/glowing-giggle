<?php

namespace App\Http\Controllers\Dashboard\Item;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\Item\Attachment\DocumentStoreRequest;
use App\Http\Requests\Dashboard\Item\Attachment\ImageStoreRequest;
use App\Models\Item;
use App\Services\ProductItem\AttachmentService;
use App\Traits\FormatResponseTrait;
use Illuminate\Http\JsonResponse;


class AttachmentController extends Controller
{
    use FormatResponseTrait;

    private AttachmentService $attachmentService;

    public function __construct(AttachmentService $attachmentService)
    {
        $this->attachmentService = $attachmentService;
    }// End Construct

    public function storeImage(ImageStoreRequest $request, Item $item): JsonResponse
    {

        try {

            return $this->attachmentService->store($request->images, $item, 'image', 'items/images');

        } catch (\Exception $e) {

            return $this->returnError('', $e->getMessage());
        }

    }// End StoreImage

    public function destroyImage(Item $item, $image): JsonResponse
    {

        try {

            return $this->attachmentService->destroyItemAttachment($item, 'items/images', $image, 'image');


        } catch (\Exception $e) {

            return $this->returnError('', $e->getMessage());

        }
    }// End DestroyDocument


    public function storeDocument(DocumentStoreRequest $request, Item $item): JsonResponse
    {

        try {
            return $this->attachmentService->store($request->documents, $item, 'document', 'items/documents');

        } catch (\Exception $e) {

            return $this->returnError('', $e->getMessage());
        }
    }// End StoreDocument

    public function destroyDocument(Item $item, $document): JsonResponse
    {
        try {
            return $this->attachmentService->destroyItemAttachment($item, 'items/documents', $document, 'document');

        } catch (\Exception $e) {

            return $this->returnError('', $e->getMessage());

        }
    }// End DestroyDocument
}
