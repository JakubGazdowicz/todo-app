<?php

namespace App\Virtual\Requests\User;

use OpenApi\Attributes as OA;

#[OA\Schema(
    title: 'Update User',
    xml: new OA\Xml(name: 'UpdateUserRequest')
)]
class UpdateUserRequest
{
    #[OA\Property]
    public string $name;

    #[OA\Property]
    public string $email;
}
