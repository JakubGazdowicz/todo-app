<?php

namespace App\Services;

use App\Http\Resources\TaskResource;
use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Validation\ValidationException;

class TaskService
{
    public function getTasks(): AnonymousResourceCollection
    {
        return TaskResource::collection(Task::all());
    }

    public function getOne(Task $task): TaskResource
    {
        return TaskResource::make($task->load('taskCategory', 'user'));
    }

    /**
     * @throws ValidationException
     */
    public function store(array $data): void
    {
        Task::create($data);
    }

    public function update(Task $task, array $data): void
    {
        $task->update($data);
    }

    public function delete(Task $task): void
    {
        $task->delete();
    }

    public function attachUser(Task $task, array $data): void
    {
        $task->update($data);
    }

    public function attachTaskCategory(Task $task, array $data): void
    {
        $task->update($data);
    }
}
