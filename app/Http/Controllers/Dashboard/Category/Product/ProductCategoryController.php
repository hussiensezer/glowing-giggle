<?php

namespace App\Http\Controllers\Dashboard\Category\Product;

use App\Http\Controllers\Controller;
use App\Services\Category\CategoryService;
use App\Traits\FormatResponseTrait;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ProductCategoryController extends Controller
{
    use FormatResponseTrait;
    private CategoryService $categoryService ;

    public function __construct(CategoryService $categoryService)
    {
        $this->categoryService = $categoryService;

    }// End Construct

    public function data(Request $request): JsonResponse
    {
        $categories = $this->categoryService->data('product', $request);
        return $this->returnData('categories', $categories);
    }// End categories


    public function categories() :JsonResponse
    {
        $categories = $this->categoryService->categories('product');
        return $this->returnData('categories', $categories);
    }//End Categories Api

    public function subCategories($category) :JsonResponse
    {
        $subCategories = $this->categoryService->subCategories('product',$category);
        return $this->returnData('subCategories', $subCategories);
    }//End Categories Api

    public function filter(Request $request): JsonResponse
    {
        $categories = $this->categoryService->filter('product', $request);
        return $this->returnData('categories', $categories);
    }// End filter
}
