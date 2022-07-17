<?php

namespace App\Http\Controllers\Dashboard\Inventory;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\Inventory\InventorySettingUpdateRequest;
use App\Services\Inventory\InventorySettingService;
use App\Traits\FormatResponseTrait;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class InventorySettingController extends Controller
{
    use FormatResponseTrait;

    public function index()
    {
        return view('dashboard.admin.inventory.setting.index');
    }// End Index

    public function data() :JsonResponse
    {
        $setting = (new InventorySettingService())->data();
        return $this->returnData('setting', $setting);
    }// End Data
    public function update(InventorySettingUpdateRequest $request) :JsonResponse
    {

        try{
            $updateSetting = (new InventorySettingService())->updateSetting($request);
            return $this->returnSuccessMessage("Congratulation Inventory Setting Update  Successfully");

        }
        catch (\Exception $e) {
            return $this->returnError('',$e->getMessage());
        }
    }// End Update
}
