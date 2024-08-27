<?php

namespace App\Virtual\Requests\User;

use OpenApi\Attributes as OA;

#[OA\Schema(
    title: 'Create User',
    xml: new OA\Xml(name: 'StoreUserRequest')
)]
class StoreUserRequest
{
    #[OA\Property]
    public string $name;

    #[OA\Property]
    public string $email;

    #[OA\Property]
    public string $password;
}
