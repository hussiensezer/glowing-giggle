<?php

namespace App\Http\Controllers\Dashboard\Product;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\Product\ComplexAttribute\ComplexAttributeStoreRequest;
use App\Models\Product;
use App\Services\ProductItem\ComplexAttributeService;
use App\Traits\FormatResponseTrait;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ComplexAttributeController extends Controller
{
    use FormatResponseTrait;
    private ComplexAttributeService $complexAttributeService;

    public function __construct(ComplexAttributeService $complexAttributeService)
    {
        $this->complexAttributeService = $complexAttributeService;
    }
    public function store(ComplexAttributeStoreRequest $request, Product $product) :JsonResponse
    {
        try {
            return $this->complexAttributeService->storeComplexAttribute($product,$request->complex, $request->complex_attributes);
        } catch (\Exception $e) {
            return $this->returnError('', $e->getMessage());
        }
    }// End Store

    public function destroy(Product $product,$complex_attribute) :JsonResponse
    {
        try {
            return $this->complexAttributeService->destroyProductComplexAttribute($product,$complex_attribute);
        } catch (\Exception $e) {
            return $this->returnError('', $e->getMessage());
        }
    }// End Destroy
}
