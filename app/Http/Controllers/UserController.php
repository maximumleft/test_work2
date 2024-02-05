<?php

namespace App\Http\Controllers;

use App\Http\Requests\User\StoreRequest;
use App\Http\Requests\User\UpdateRequest;
use App\Http\Resources\User\Resource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Http\Response;

class UserController extends BaseController
{
    public function index(): ResourceCollection
    {
        return Resource::collection(User::all());
    }

    public function show(Request $request): Resource
    {
        return new Resource($this->userService->getUser($request));
    }

    public function store(StoreRequest $request): Resource
    {
        return new Resource(User::create($request->validated()));
    }

    public function update(Request $req,UpdateRequest $request): Resource
    {
        return new Resource($this->userService->updateUser($req,$request));
    }

    public function destroy(Request $request): Response
    {
        $this->userService->getUser($request)->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
