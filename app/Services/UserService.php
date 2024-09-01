<?php

namespace App\Services;

use App\Http\Resources\UserResource;
use App\Models\User;
use Exception;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Facades\Hash;

class UserService
{
    public function getUsers(): AnonymousResourceCollection
    {
        return UserResource::collection(User::paginate(10));
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

    public function search(?string $search = null): AnonymousResourceCollection
    {
        if (!$search) {
            return UserResource::collection(User::all());
        }

        $usersSearched = User::search($search)->get();

        return UserResource::collection($usersSearched);
    }
}
