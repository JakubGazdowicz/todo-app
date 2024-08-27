<?php

namespace App\Virtual\Requests\TaskCategory;

use OpenApi\Attributes as OA;

#[OA\Schema(
    title: 'Update Task Category',
    xml: new OA\Xml(name: 'UpdateTaskCategoryRequest')
)]
class UpdateTaskCategoryRequest
{
    #[OA\Property]
    public string $name;

    #[OA\Property]
    public ?int $user_id;
}
