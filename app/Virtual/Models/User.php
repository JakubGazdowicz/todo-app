<?php

namespace App\Virtual\Models;

use OpenApi\Attributes as OA;

#[OA\Schema(
    title: 'User',
    xml: new OA\Xml(name: 'User')
)]
class User
{
    #[OA\Property]
    public int $id;

    #[OA\Property]
    public string $name;

    #[OA\Property]
    public string $email;

    #[OA\Property]
    public string $password;

    #[OA\Property]
    public string $created_at;

    #[OA\Property]
    public string $updated_at;
}
