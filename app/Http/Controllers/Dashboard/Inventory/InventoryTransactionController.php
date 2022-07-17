<?php

namespace App\Http\Controllers\Dashboard\Inventory;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\Inventory\Transaction\DepositUpdateRequest;
use App\Http\Requests\Dashboard\Inventory\Transaction\WithdrewUpdateRequest;
use App\Models\Item;
use App\Models\Product;
use App\Services\Inventory\InventoryTransactionService;
use App\Traits\FormatResponseTrait;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class InventoryTransactionController extends Controller
{
    use FormatResponseTrait;

    private InventoryTransactionService $inventoryTransactionService;

    public function __construct(InventoryTransactionService $inventoryTransactionService)
    {
        $this->inventoryTransactionService = $inventoryTransactionService;
    }// End Construct


    public function index()
    {
        return view('dashboard.admin.inventory.transactions.processes');
    }// End Index

    public function data(Request $request) :JsonResponse
    {
        $transactions =  $this->data($request);
        return $this->returnData('transactions', $transactions);
    }// End Data

    /*
     *|----------------------------------
     *| Item [Withdrew,Deposit]
     *|-----------------------------------
     */

    public function itemWithdraw(WithdrewUpdateRequest $request, Item $item): JsonResponse
    {
        try {
            $parentItem = Item::find($item->parent_id);
            return $this->inventoryTransactionService->Withdraw($request, $item, $parentItem, NULL, $item->id);

        } catch (\Exception $e) {
            DB::rollback();
            return $this->returnError('', $e->getMessage());
        }
    }// End ItemWithdrew

    public function itemDeposit(DepositUpdateRequest $request, Item $item) :JsonResponse
    {
        DB::beginTransaction();
        try {
            $parentItem = Item::find($item->parent_id);
            $this->inventoryTransactionService->deposit($request, $item, $parentItem, NULL, $item->id);
            DB::commit();
            return $this->returnSuccessMessage("Congratulation Deposit Transaction  Successfully");

        } catch (\Exception $e) {
            DB::rollback();
            return $this->returnError('', $e->getMessage());

        }
    }// End ItemDeposit

    /*
    *|----------------------------------
    *| Product [Withdrew,Deposit]
    *|-----------------------------------
    */

    public function productWithdraw(WithdrewUpdateRequest $request, Product $product): JsonResponse
    {
        try {
            $parentProduct = Product::find($product->parent_id);
            return $this->inventoryTransactionService->Withdraw($request, $product, $parentProduct, $product->id,NULL );

        } catch (\Exception $e) {
            DB::rollback();
            return $this->returnError('', $e->getMessage());
        }
    }// End ProductWithdraw

    public function productDeposit(DepositUpdateRequest $request,Product $product) :JsonResponse
    {
        DB::beginTransaction();
        try {
            $parentProduct = Product::find($product->parent_id);
            $this->inventoryTransactionService->deposit($request, $product, $parentProduct, $product->id,NULL );
            DB::commit();
            return $this->returnSuccessMessage("Congratulation Deposit Transaction  Successfully");

        } catch (\Exception $e) {
            DB::rollback();
            return $this->returnError('', $e->getMessage());

        }
    }// End ProductDeposit
}
