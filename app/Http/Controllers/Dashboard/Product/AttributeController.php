<?php

namespace App\Http\Controllers\Dashboard\Product;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\Product\Attribute\AttributeStoreRequest;
use App\Http\Requests\Dashboard\Product\Attribute\AttributeUpdateRequest;
use App\Models\Product;
use App\Services\ProductItem\AttributeService;
use App\Traits\FormatResponseTrait;
use Illuminate\Http\JsonResponse;


class AttributeController extends Controller
{
    use FormatResponseTrait;

    private AttributeService $attributeService;

    public function __construct(AttributeService $attributeService)
    {
        $this->attributeService = $attributeService;
    }// End Construct

    public function store(AttributeStoreRequest $request,Product $product) :JsonResponse
    {
        try {
            return $this->attributeService->storeAttribute($product, $request['attributes']);
        } catch (\Exception $e) {
            return $this->returnError('', $e->getMessage());
        }
    }// End Store

    public function update(AttributeUpdateRequest $request,Product $product,$attribute) :JsonResponse
    {
        try {
            return $this->attributeService->updateProductAttribute($product, $attribute, $request);
        } catch (\Exception $e) {
            return $this->returnError('', $e->getMessage());
        }
    }// End Update

    public function destroy(Product $product,$attribute) :JsonResponse
    {
        try {
            return $this->attributeService->destroyProductAttribute($product,$attribute);
        } catch (\Exception $e) {
            return $this->returnError('', $e->getMessage());
        }
    }// End Destroy
}
