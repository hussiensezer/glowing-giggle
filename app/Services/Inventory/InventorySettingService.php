<?php

namespace App\Services\Inventory;

use App\Models\InventorySetting;
use App\Traits\FormatResponseTrait;

class InventorySettingService
{
    use FormatResponseTrait;

    public function data()
    {
        return InventorySetting::first();
    }// End Setting

    public function updateSetting($request)
    {
        $inventorySetting = InventorySetting::first();

        $inventorySetting->update([
            'manual_withdraw' => $request->manual_withdraw,
            'limit_alert' => $request->limit_alert,
            'prefix_code_item' => $request->prefix_code_item,
            'prefix_code_product' => $request->prefix_code_product
        ]);
    }// Update Setting

}
