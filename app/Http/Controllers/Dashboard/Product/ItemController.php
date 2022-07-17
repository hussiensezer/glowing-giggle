<?php

namespace App\Http\Controllers\Dashboard\Product;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\Product\Item\ItemStoreRequest;
use App\Http\Requests\Dashboard\Product\Item\ItemUpdateRequest;
use App\Models\Product;
use App\Services\Product\ItemService;
use Illuminate\Http\JsonResponse;


class ItemController extends Controller
{
    private ItemService $itemService;

    public function __construct(ItemService $itemService)
    {
        $this->itemService =  $itemService;
    }// End Construct

    public function store(ItemStoreRequest $request ,Product $product) :JsonResponse
    {
        try {

            return  $this->itemService->storeProductItem($product,$request->items);
        } catch (\Exception $e) {
            return $this->returnError('', $e->getMessage());
        }
    }// End Store


    public function update(ItemUpdateRequest $request, Product $product, $item) :JsonResponse
    {
        try {

            return $this->itemService->updateProductItem($request, $product, $item);
        } catch (\Exception $e) {
            return $this->returnError('', $e->getMessage());
        }
    }// End Update

    public function destroy(Product $product, $item) :JsonResponse
    {
        try {
            return $this->itemService->destroyProductItem($product, $item);
        } catch (\Exception $e) {
            return $this->returnError('', $e->getMessage());
        }
    }//End Destroy
}
