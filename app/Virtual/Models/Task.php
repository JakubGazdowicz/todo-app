<?php

namespace App\Virtual\Models;

use OpenApi\Attributes as OA;

#[OA\Schema(
    title: 'Task',
    xml: new OA\Xml(name: 'Task')
)]
class Task
{
    #[OA\Property]
    public int $id;

    #[OA\Property]
    public string $name;

    #[OA\Property]
    public ?string $description;

    #[OA\Property]
    public int $duration_minutes;

    #[OA\Property]
    public ?int $user_id;

    #[OA\Property]
    public ?int $task_category_id;

    #[OA\Property]
    public string $created_at;

    #[OA\Property]
    public string $updated_at;
}
