<?php

namespace App\Virtual\Models;

use OpenApi\Attributes as OA;

#[OA\Schema(
    title: 'Task Category',
    xml: new OA\Xml(name: 'TaskCategory')
)]
class TaskCategory
{
    #[OA\Property]
    public int $id;

    #[OA\Property]
    public string $name;

    #[OA\Property]
    public ?int $user_id;

    #[OA\Property]
    public string $created_at;

    #[OA\Property]
    public string $updated_at;
}
