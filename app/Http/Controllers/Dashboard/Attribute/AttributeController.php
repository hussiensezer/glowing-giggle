<?php

namespace App\Http\Controllers\Dashboard\Attribute;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\Attribute\AttributeStoreRequest;
use App\Http\Requests\Dashboard\Attribute\AttributeUpdateRequest;
use App\Models\Attribute;
use App\Services\Attribute\AttributeService;
use App\Traits\FormatResponseTrait;
use Illuminate\Http\JsonResponse;


class AttributeController extends Controller
{
    use FormatResponseTrait;

    private AttributeService $attributeService;

    public function __construct(AttributeService $attributeService)
    {
        $this->attributeService = $attributeService;
    }// End Construct


    public function index()
    {
        $attributes = $this->attributeService->attributes();

        return view('dashboard.admin.attributes.index', compact('attributes'));
    }// End Index

    public function create()
    {
        return view('dashboard.admin.attributes.create');
    }// End Create

    public function store(AttributeStoreRequest $request): JsonResponse
    {

        try {
            $this->attributeService->storeAttribute($request);
            return $this->returnSuccessMessage('Congratulation Attribute Created Successfully');

        } catch (\Exception $e) {
            return $this->returnError('', $e->getMessage());
        }
    }// End Store

    public function edit(Attribute $attribute)
    {
        return view('dashboard.admin.attributes.edit', compact('attribute'));
    }// End Edit

    public function update(AttributeUpdateRequest $request, Attribute $attribute): object
    {
        try {
            $this->attributeService->updateAttribute($request, $attribute);
            return $this->returnSuccessMessage('Congratulation Attribute Updated Successfully');

        } catch (\Exception $e) {
            return $this->returnError('', $e->getMessage());
        }
    }// End Update

    public function show(Attribute $attribute)
    {
        return view('dashboard.admin.attributes.show', compact('attribute'));
    }// End Show
}
