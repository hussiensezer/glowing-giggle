<?php

namespace App\Http\Controllers\Dashboard\Item;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\Item\ItemUpdateRequest;
use App\Models\Item;
use App\Services\ProductItem\BaseInformationService;
use App\Services\ProductItem\ProductItemService;
use App\Traits\FormatResponseTrait;
use Illuminate\Http\JsonResponse;


class BaseInformationController extends Controller
{
    use FormatResponseTrait;
    public function updateBaseInformation(ItemUpdateRequest $request, Item  $item) :JsonResponse
    {

        try {
            $updateBase = new BaseInformationService();

            $updateBase->updateBaseInformation($item, $request, 'items/thumbnails', (new ProductItemService())->inventorSetting()->prefix_code_item);
            return $this->returnSuccessMessage('Congratulation BaseInformation Of Item Updated Successfully');

        } catch (\Exception $e) {
            return $this->returnError('', $e->getMessage());

        }
    }// End UpdateBase Information
}
