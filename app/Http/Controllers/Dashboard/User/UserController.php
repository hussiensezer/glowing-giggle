<?php

namespace App\Http\Controllers\Dashboard\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\User\UserStoreRequest;
use App\Http\Requests\Dashboard\User\UserUpdateRequest;
use App\Services\User\UserService;
use App\Traits\FormatResponseTrait;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;


class UserController extends Controller
{
    use FormatResponseTrait;

    private UserService $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }// End Construct

    public function index()
    {
        $users = $this->userService->users();
        return view('dashboard.admin.user.index', compact('users'));
    }// End Index

    public function show($id)
    {
        $user = $this->userService->user($id);
        return view('dashboard.admin.user.show', compact('user'));
    }// End Show

    public function create()
    {
        $roles = $this->userService->roles();
        return view('dashboard.admin.user.create', compact('roles'));
    }// End Create

    public function store(UserStoreRequest  $request) :JsonResponse
    {
        DB::beginTransaction();
        try {
            $this->userService->store($request);
            DB::commit();
            return $this->returnSuccessMessage('Congratulation User Created Successfully');

        } catch (\Exception $e) {
            DB::rollback();
            return $this->returnError('', $e->getMessage());
        }
    }// End Store

    public function edit($user)
    {
        $user = $this->userService->user($user);
        $roles = $this->userService->roles();
        return view('dashboard.admin.user.edit', compact('user', 'roles'));
    }// End Edit

    public function update(UserUpdateRequest $request , $user) :JsonResponse
    {
        DB::beginTransaction();
        try {
            $this->userService->update($request,$user);
            DB::commit();
            return $this->returnSuccessMessage('Congratulation User Updated Successfully');

        } catch (\Exception $e) {
            DB::rollback();
            return $this->returnError('', $e->getMessage());
        }
    }// End Update


}
