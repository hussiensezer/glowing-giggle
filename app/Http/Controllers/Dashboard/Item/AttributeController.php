<?php

namespace App\Http\Controllers\Dashboard\Item;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\Item\Attribute\AttributeStoreRequest;
use App\Http\Requests\Dashboard\Item\Attribute\AttributeUpdateRequest;
use App\Models\Item;
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

    public function store(AttributeStoreRequest $request,Item $item) :JsonResponse
    {
        try {
            return $this->attributeService->storeAttribute($item, $request['attributes']);
        } catch (\Exception $e) {
            return $this->returnError('', $e->getMessage());
        }
    }// End Store

    public function update(AttributeUpdateRequest $request,Item $item,$attribute) :JsonResponse
    {
        try {
            return $this->attributeService->updateItemAttribute($item, $attribute, $request);
        } catch (\Exception $e) {
            return $this->returnError('', $e->getMessage());
        }
    }// End Update

    public function destroy(Item $item,$attribute) :JsonResponse
    {
        try {
            return $this->attributeService->destroyItemAttribute($item,$attribute);
        } catch (\Exception $e) {
            return $this->returnError('', $e->getMessage());
        }
    }// End Destroy
}
