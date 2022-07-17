<?php

namespace App\Services\User;

use App\Models\User;
use Spatie\Permission\Models\Role;

class UserService
{
    public function users() :object
    {
        return User::with([
            'roles' => fn($q) => $q->select(['id', 'name']),
        ])->latest()->paginate(config('setting.LimitPaginate'));
    }// End Users

    public function user(int $id) :object
    {
        return User::with([
            'roles' => fn($q) => $q->select(['id', 'name']),
        ])->findOrFail($id);
    }// End User

    public function roles() :object
    {
        return Role::select(['id','name'])->get();
    }// End Roles

    public function store($request)
    {
        $user = User::create([
            'name'      => $request->name,
            'password'  => bcrypt($request->password),
            'status'    => $request->status,
            'email'     => $request->email,
        ]);
        $user->assignRole($request->roles);
    }// End Store


}
