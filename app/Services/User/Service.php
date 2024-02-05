<?php

namespace App\Services\User;

use App\Models\User;

class Service
{
    public function getUser($request)
    {
        $userId = $request->header('User-Id');
        $user = User::find($userId);
        return $user;
    }

    public function updateUser($req, $request)
    {
        $user = $this->getUser($req);
        $user->update($request->validated());

        return $user;
    }

}
