<?php

namespace App\Virtual\Resources;

use OpenApi\Attributes as OA;

#[OA\Schema(
    title: 'TaskResource',
    xml: new OA\Xml(name: 'TaskResource')
)]
class TaskResource
{
    #[OA\Property]
    public int $id;

    #[OA\Property]
    public string $name;

    #[OA\Property]
    public int $durationMinutes;

    #[OA\Property]
    public ?string $description;

    #[OA\Property]
    public ?int $userId;

    #[OA\Property]
    public ?int $taskCategoryId;

    #[OA\Property]
    public string $createdAt;

    #[OA\Property]
    public string $updatedAt;

    #[OA\Property]
    public ?UserResource $user;

    #[OA\Property]
    public ?TaskCategoryResource $taskCategory;
}
