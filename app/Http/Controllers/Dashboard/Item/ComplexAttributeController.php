<?php

namespace App\Http\Controllers\Dashboard\Item;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\Item\ComplexAttribute\ComplexAttributeStoreRequest;
use App\Models\Item;
use App\Services\ProductItem\ComplexAttributeService;
use App\Traits\FormatResponseTrait;
use Illuminate\Http\JsonResponse;


class ComplexAttributeController extends Controller
{
    use FormatResponseTrait;
    private ComplexAttributeService $complexAttributeService;

    public function __construct(ComplexAttributeService $complexAttributeService)
    {
        $this->complexAttributeService = $complexAttributeService;
    }
    public function store(ComplexAttributeStoreRequest $request, Item $item) :JsonResponse
    {
        try {
            return $this->complexAttributeService->storeComplexAttribute($item,$request->complex, $request->complex_attributes);
        } catch (\Exception $e) {
            return $this->returnError('', $e->getMessage());
        }
    }// End Store

    public function destroy(Item $item,$complex_attribute) :JsonResponse
    {
        try {
            return $this->complexAttributeService->destroyItemComplexAttribute($item,$complex_attribute);
        } catch (\Exception $e) {
            return $this->returnError('', $e->getMessage());
        }
    }// End Destroy
}
