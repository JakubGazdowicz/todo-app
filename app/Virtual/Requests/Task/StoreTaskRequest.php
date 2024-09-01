<?php

namespace App\Virtual\Requests\Task;

use OpenApi\Attributes as OA;

#[OA\Schema(
    title: 'Update Task',
    xml: new OA\Xml(name: 'UpdateTaskRequest')
)]
class StoreTaskRequest
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
