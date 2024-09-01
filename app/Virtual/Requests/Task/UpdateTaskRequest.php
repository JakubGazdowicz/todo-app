<?php

namespace App\Virtual\Requests\Task;

use OpenApi\Attributes as OA;

#[OA\Schema(
    title: 'Create Task',
    xml: new OA\Xml(name: 'StoreTaskRequest')
)]
class UpdateTaskRequest
{
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
}
