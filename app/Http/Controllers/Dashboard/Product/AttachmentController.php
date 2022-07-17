<?php

namespace App\Http\Controllers\Dashboard\Product;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\Product\Attachment\DocumentStoreRequest;
use App\Http\Requests\Dashboard\Product\Attachment\ImageStoreRequest;
use App\Models\Product;
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

    public function storeImage(ImageStoreRequest $request, Product $product): JsonResponse
    {

        try {

            return $this->attachmentService->store($request->images, $product, 'image', 'products/images');
        } catch (\Exception $e) {

            return $this->returnError('', $e->getMessage());
        }

    }// End StoreImage

    public function destroyImage(Product $product, $image): JsonResponse
    {
        try {

            return $this->attachmentService->destroyProductAttachment($product, 'products/documents', $image, 'document');

        } catch (\Exception $e) {

            return $this->returnError('', $e->getMessage());

        }
    }// End DestroyDocument


    public function storeDocument(DocumentStoreRequest $request, Product $product): JsonResponse
    {
        try {

            return $this->attachmentService->store($request->documents, $product, 'document', 'products/documents');


        } catch (\Exception $e) {

            return $this->returnError('', $e->getMessage());
        }

    }// End StoreDocument

    public function destroyDocument(Product $product, $attachment): JsonResponse
    {
        try {

            return $this->attachmentService->destroyProductAttachment($product, 'products/documents', $attachment, 'document');

        } catch (\Exception $e) {

            return $this->returnError('', $e->getMessage());

        }

    }// End DestroyDocument
}
