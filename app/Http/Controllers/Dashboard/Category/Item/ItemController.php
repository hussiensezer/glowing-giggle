<?php

namespace App\Http\Controllers\Dashboard\Category\Item;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\Category\CategoryStoreRequest;
use App\Http\Requests\Dashboard\Category\CategoryUpdateRequest;
use App\Models\Category;
use App\Services\Category\CategoryService;
use App\Traits\FormatResponseTrait;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class ItemController extends Controller
{

    use FormatResponseTrait;
    private CategoryService $categoryService ;

    public function __construct(CategoryService $categoryService)
    {
        $this->categoryService = $categoryService;

    }// End Construct

    public function index(Request $request)
    {
        return view('dashboard.admin.inventory.categories.item.index');
    }// End Index


    public function create()
    {

        $categories = $this->categoryService->categoriesWithSub('item');
        return view('dashboard.admin.inventory.categories.item.create', compact('categories'));

    }// End Create

    public function store(CategoryStoreRequest $request) :JsonResponse
    {
        DB::beginTransaction();
        try {

            $this->categoryService->storeCategory('item',$request);
            DB::commit();

            return $this->returnSuccessMessage('Congratulation Category Created Successfully');

        } catch (\Exception $e) {
            DB::rollback();
            return $this->returnError('', $e->getMessage());

        }

    }// End Store

    public function edit(Category $category)
    {

        $categories = $this->categoryService->categoriesWithSub('item');
        return view('dashboard.admin.inventory.categories.item.edit', compact('categories', 'category'));

    }// End Edit

    public function update(CategoryUpdateRequest $request, Category $category) :JsonResponse
    {
        DB::beginTransaction();
        try {
            $this->categoryService->updateCategory($request, $category);
            DB::commit();
            return $this->returnSuccessMessage('Congratulation Category Updated Successfully');

        } catch (\Exception $e) {
            DB::rollback();
            return $this->returnError('', $e->getMessage());

        }
    }// End Update

    public function show(Category $category)
    {
        return view('dashboard.admin.inventory.categories.item.show', compact('category'));

    }// End Show


}

