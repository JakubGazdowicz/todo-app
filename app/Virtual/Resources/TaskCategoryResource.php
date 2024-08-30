<?php

namespace App\Virtual\Resources;

use OpenApi\Attributes as OA;

#[OA\Schema(
    title: 'TaskCategoryResource',
    xml: new OA\Xml(name: 'TaskCategoryResource')
)]
class TaskCategoryResource
{
    #[OA\Property]
    public int $id;

    #[OA\Property]
    public string $name;

    #[OA\Property]
    public ?int $userId;

    #[OA\Property]
    public string $created_at;

    #[OA\Property]
    public string $updated_at;

    #[OA\Property]
    public ?UserResource $user;
}
