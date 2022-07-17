<?php

namespace App\Http\Controllers\Dashboard\Item;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\Item\ItemStoreRequest;
use App\Services\Item\ItemService;
use App\Traits\FormatResponseTrait;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ItemController extends Controller
{
    use FormatResponseTrait;

    private ItemService $itemService;

    public function __construct(ItemService $itemService)
    {
        $this->itemService = $itemService;

    }// End Construct

    public function index()
    {
        return view('dashboard.admin.inventory.items.index');
    }// End Index

    public function create()
    {
        $data = $this->itemService->createItem();
        return view('dashboard.admin.inventory.items.create', $data);
    }//End Create

    public function store(ItemStoreRequest $request): JsonResponse
    {

        DB::beginTransaction();
        try {
            $this->itemService->storeItem($request);
            DB::commit();
            return $this->returnSuccessMessage('Congratulation Item Created Successfully');
        } catch (\Exception $e) {
            DB::rollback();
            return $this->returnError('', $e->getMessage());
        }


    }// End Store

    public function edit($id)
    {
        $item = $this->itemService->editItem($id);
        return view('dashboard.admin.inventory.items.edit', $item);
    }// End Edit

    public function show($id)
    {
        $item = $this->itemService->showItem($id);
        return view('dashboard.admin.inventory.items.show', compact('item'));
    }// End Show

    public function data(Request $request):JsonResponse
    {
        return $this->returnData('items',$this->itemService->items($request));
    }// End Data




}
