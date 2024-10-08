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
    public string $createdAt;

    #[OA\Property]
    public string $updatedAt;

    #[OA\Property]
    public ?UserResource $user;
}
