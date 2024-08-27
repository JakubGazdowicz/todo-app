<?php

namespace App\Services;

use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Facades\Hash;

class UserService
{
    public function getUsers(): AnonymousResourceCollection
    {
        return UserResource::collection(User::all());
    }

    public function getOne(User $user): UserResource
    {
        return UserResource::make($user);
    }

    public function store(array $data): void
    {
        $data['password'] = Hash::make($data['password']);

        User::create($data);
    }

    public function update(User $user, array $data): void
    {
        $user->update($data);
    }

    public function delete(User $user): void
    {
        $user->delete();
    }
}
