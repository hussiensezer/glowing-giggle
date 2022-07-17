<?php

namespace App\Http\Controllers\Dashboard\Role;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\Role\RoleStoreRequest;
use App\Http\Requests\Dashboard\Role\RoleUpdateRequest;
use App\Services\Role\RoleService;
use App\Traits\FormatResponseTrait;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    use FormatResponseTrait;

    private RoleService $roleService;

    public function __construct(RoleService $roleService)
    {
        $this->roleService = $roleService;
    }

    public function index()
    {
        $roles = $this->roleService->roles();
        return view('dashboard.admin.roles.index', compact('roles'));
    }// End Index

    public function create()
    {
        $permissions = $this->roleService->permissions();
        return view('dashboard.admin.roles.create', compact('permissions'));
    }// End Create

    public function store(RoleStoreRequest $request): JsonResponse
    {
        DB::beginTransaction();
        try {
            $role = $this->roleService->store($request);
            DB::commit();
            return $this->returnSuccessMessage('Congratulation Role Created Successfully');

        } catch (\Exception $e) {
            DB::rollback();
            return $this->returnError('', $e->getMessage());
        }

    }// End Store

    public function edit($role)
    {
        $role = $this->roleService->edit($role);
        return view('dashboard.admin.roles.edit', $role);
    }// End Edit

    public function update(RoleUpdateRequest $request ,$role) :JsonResponse
    {
        DB::beginTransaction();
        try {
            $role = $this->roleService->update($request ,$role);
            DB::commit();
            return $this->returnSuccessMessage('Congratulation Role Updated Successfully');

        } catch (\Exception $e) {
            DB::rollback();
            return $this->returnError('', $e->getMessage());
        }
    }// End Update

    public function destroy($role) :JsonResponse
    {
        try {
            $this->roleService->destroy($role);
            return $this->returnSuccessMessage('Congratulation Role Deleted Successfully');

        } catch (\Exception $e) {

            return $this->returnError('', $e->getMessage());
        }
    }// End Destroy
}
