<?php

namespace App\Services;

use App\Http\Resources\TaskCategoryResource;
use App\Models\TaskCategory;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class TaskCategoryService
{
    public function getTaskCategories(): AnonymousResourceCollection
    {
        return TaskCategoryResource::collection(TaskCategory::paginate(10));
    }

    public function getOne(TaskCategory $taskCategory): TaskCategoryResource
    {
        return TaskCategoryResource::make($taskCategory->load('user'));
    }

    public function store(array $data): void
    {
        TaskCategory::create($data);
    }

    public function update(TaskCategory $taskCategory, array $data): void
    {
        $taskCategory->update($data);
    }

    public function delete(TaskCategory $taskCategory): void
    {
        $taskCategory->delete();
    }

    public function search(?string $search = null): AnonymousResourceCollection
    {
        if (!$search) {
            return TaskCategoryResource::collection(TaskCategory::all());
        }

        $taskCategoriesSearched = TaskCategory::search($search)->get();

        return TaskCategoryResource::collection($taskCategoriesSearched);
    }
}
