<?php

namespace App\Virtual\Requests\TaskCategory;

use OpenApi\Attributes as OA;

#[OA\Schema(
    title: 'Create Task Category',
    xml: new OA\Xml(name: 'StoreTaskCategoryRequest')
)]
class StoreTaskCategoryRequest
{
    #[OA\Property]
    public string $name;

    #[OA\Property]
    public ?int $user_id;
}
