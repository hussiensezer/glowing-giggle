<?php

namespace App\Http\Controllers\Dashboard\Product;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\Product\ProductStoreRequest;
use App\Services\Product\ProductService;
use App\Traits\FormatResponseTrait;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    use FormatResponseTrait;
    private ProductService $productService;

    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }

    public function index()
    {
     return view('dashboard.admin.inventory.products.index');

    }// End Index

    public function create()
    {
        $data = $this->productService->createProduct();

        return view('dashboard.admin.inventory.products.create', $data);
    }

    public function store(ProductStoreRequest $request) :JsonResponse
    {
        DB::beginTransaction();
        try {
            $this->productService->storeProduct($request);
            DB::commit();
            return $this->returnSuccessMessage('Congratulation Product Created Successfully');
        }
        catch (\Exception $e) {
            DB::rollback();
            return $this->returnError('', $e->getMessage());
        }


    }// End Store

    public function edit($id)
    {
        $data = $this->productService->editProduct($id);

        return view('dashboard.admin.inventory.products.edit', $data);

    }// End Edit

    public function show($id)
    {
        $product =  $this->productService->showProduct($id);
        return view('dashboard.admin.inventory.products.show', compact($product));
    }// End Show

    public function data(Request $request):JsonResponse
    {
      $products = $this->productService->products($request);
      return $this->returnData('products', $products);
    }// End Data

}
