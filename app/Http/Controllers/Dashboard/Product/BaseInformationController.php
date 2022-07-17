<?php

namespace App\Http\Controllers\Dashboard\Product;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\Product\ProductUpdateRequest;
use App\Models\Product;
use App\Services\ProductItem\BaseInformationService;
use App\Services\ProductItem\ProductItemService;
use App\Traits\FormatResponseTrait;
use Illuminate\Http\JsonResponse;


class BaseInformationController extends Controller
{
    use FormatResponseTrait;
    public function updateBaseInformation(ProductUpdateRequest $request, Product  $product) :JsonResponse
    {

        try {
            $updateBase = new BaseInformationService();

            $updateBase->updateBaseInformation($product, $request, 'products/thumbnails',(new ProductItemService())->inventorSetting()->prefix_code_item);
            return $this->returnSuccessMessage('Congratulation BaseInformation Of Product Updated Successfully');

        } catch (\Exception $e) {
            return $this->returnError('', $e->getMessage());

        }
    }// End UpdateBase Information
}
