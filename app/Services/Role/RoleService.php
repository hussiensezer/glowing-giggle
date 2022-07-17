<?php

namespace App\Services\Role;

use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleService
{
    public function roles(): object
    {
        return Role::select(['id', 'name'])->latest()->paginate(config('setting.LimitPaginate'));

    }// End Roles


    public function permissions(): object
    {
        return Permission::select(['id', 'name'])->get();
    }// End Permissions

    public function store($request)
    {
        $role = Role::create([
            'name' => $request->name,
            'guard_name' => $request->guard
        ]);

        foreach ($request->permissions as $permission) {
            $role->givePermissionTo($permission);
        }
    }// End Store

    public function edit($id): array
    {

        $role = $this->role($id);
        $rolePermissions = $this->rolePermissions($role);
        return [
            'role' => $role,
            'rolePermissions' => $rolePermissions,
            'permissions' => $this->permissions(),
        ];
    }// End Role

    public function update($request, $id)
    {
        $role = $this->role($id);
        $role->update([
            'name' => $request->name,
            'guard_name' => $request->guard,
        ]);

        $role->syncPermissions($request->permissions);
    }// End Update

    public function destroy($id)
    {
        $role = $this->role($id);
        $role->delete();
    }// End Destroy


    public function role($id): object
    {
        // Return $role
        return Role::where('name', '!=', 'Super Admin')->with(['permissions' => function ($q) {
            $q->select('id');
        }])->findOrFail($id);
    }// End Role

    public function rolePermissions($role): array
    {
        // Push The Permission of role into empty array to show the user which permission belongs to role
        $rolePermissions = [];

        foreach ($role->permissions as $permission) {
            $rolePermissions[] = $permission->id;
        }
        return $rolePermissions;

    }
}
