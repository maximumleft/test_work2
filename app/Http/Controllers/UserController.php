<?php

namespace App\Http\Controllers;

use App\Http\Requests\User\StoreRequest;
use App\Http\Requests\User\UpdateRequest;
use App\Http\Resources\User\Resource;
use App\Models\User;
use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Http\Response;

class UserController extends Controller
{
    public function index(): ResourceCollection
    {
        return Resource::collection(User::all());
    }

    public function show(): Resource
    {
        return new Resource(auth()->user());
    }

    public function store(StoreRequest $request): Resource
    {
        $user = User::create($request->validated());
        auth()->login($user);

        return new Resource($user);
    }

    public function update(UpdateRequest $request,User $user): Resource
    {
        $user->update($request->validated());

        return new Resource($user);
    }

    public function destroy(User $user): Response
    {
        $user->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
