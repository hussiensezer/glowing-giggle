<?php

namespace App\Http\Controllers\Dashboard\Product;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\Product\ManufacturingProcessUpdateRequest\ManufacturingProcessUpdateRequest;
use App\Http\Requests\Dashboard\Product\ManufacturingProcessUpdateRequest\ManufacturingProcessStoreRequest;
use App\Models\Product;
use App\Services\Product\ManufacturingProcessService;
use App\Traits\FormatResponseTrait;
use Illuminate\Http\JsonResponse;

class ManufacturingProcessController extends Controller
{
    use FormatResponseTrait;

    private ManufacturingProcessService $manufacturingProcessService;

    public function __construct(ManufacturingProcessService $manufacturingProcessService)
    {
        $this->manufacturingProcessService = $manufacturingProcessService;
    }

    public function store(ManufacturingProcessStoreRequest $request, Product $product): JsonResponse
    {
        try {


            return $this->manufacturingProcessService->storeManufacturingProcess($product, $request->manufacturing_process);

        } catch (\Exception $e) {
            return $this->returnError('', $e->getMessage());
        }
    }// End Store

    public function update(ManufacturingProcessUpdateRequest $request, Product $product, $manufacturing) :JsonResponse
    {

        try {

            return $this->manufacturingProcessService->updateManufacturingProcess($product, $manufacturing,$request);

        } catch (\Exception $e) {
            return $this->returnError('', $e->getMessage());
        }
    }// End Update

    public function destroy(Product $product,$manufacturing) :JsonResponse
    {
        try {

            return $this->manufacturingProcessService->destroyManufacturingProcess($product, $manufacturing);

        } catch (\Exception $e) {
            return $this->returnError('', $e->getMessage());
        }
    }// End Destroy


}
