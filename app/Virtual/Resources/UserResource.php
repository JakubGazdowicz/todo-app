<?php

namespace App\Virtual\Resources;

use OpenApi\Attributes as OA;

#[OA\Schema(
    title: 'UserResource',
    xml: new OA\Xml(name: 'UserResource')
)]
class UserResource
{
    #[OA\Property]
    public int $id;

    #[OA\Property]
    public string $name;

    #[OA\Property]
    public string $email;

    #[OA\Property]
    public string $created_at;

    #[OA\Property]
    public string $updated_at;
}
