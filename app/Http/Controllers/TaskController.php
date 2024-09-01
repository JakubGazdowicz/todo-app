<?php

namespace App\Http\Controllers;

use App\Http\Requests\AttachTaskCategoryToTaskRequest;
use App\Http\Requests\AttachUserToTaskRequest;
use App\Http\Requests\StoreTaskRequest;
use App\Http\Requests\UpdateTaskRequest;
use App\Models\Task;
use App\Services\TaskService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Validation\ValidationException;
use Inertia\Inertia;
use Inertia\Response;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;
use OpenApi\Attributes as OA;

class TaskController extends Controller
{
    public function __construct(protected TaskService $taskService) {}

    #[OA\Get(
        path: '/tasks',
        summary: 'Get tasks list',
        tags: ['Task'],
        responses: [
            new OA\Response(
                response: ResponseAlias::HTTP_OK,
                description: 'Tasks retrieved successfully',
                content: new OA\JsonContent(ref: '#/components/schemas/TaskResource')
            ),
            new OA\Response(response: ResponseAlias::HTTP_UNAUTHORIZED, description: 'Unauthorized'),
            new OA\Response(response: ResponseAlias::HTTP_NOT_FOUND, description: 'Not found'),
            new OA\Response(response: ResponseAlias::HTTP_INTERNAL_SERVER_ERROR, description: 'Server Error'),
        ]
    )]
    public function index(): Response
    {
        return Inertia::render('Task/Index', [
            'tasks' => $this->taskService->getTasks(),
        ]);
    }

    #[OA\Get(
        path: '/tasks/{task}',
        summary: 'Get task',
        tags: ['Task'],
        responses: [
            new OA\Response(
                response: ResponseAlias::HTTP_OK,
                description: 'Task retrieved successfully',
                content: new OA\JsonContent(ref: '#/components/schemas/TaskResource')
            ),
            new OA\Response(response: ResponseAlias::HTTP_UNAUTHORIZED, description: 'Unauthorized'),
            new OA\Response(response: ResponseAlias::HTTP_NOT_FOUND, description: 'Not found'),
            new OA\Response(response: ResponseAlias::HTTP_INTERNAL_SERVER_ERROR, description: 'Server Error'),
        ]
    )]
    public function show(Task $task): Response
    {
        return Inertia::render('Task/Show', [
            'task' => $this->taskService->getOne(task: $task),
        ]);
    }

    /**
     * @throws ValidationException
     */
    #[OA\Post(
        path: '/tasks',
        summary: 'Create new task',
        requestBody: new OA\RequestBody(
            required: true,
            content: new OA\JsonContent(ref: '#components/schemas/StoreTaskRequest')
        ),
        tags: ['Task'],
        responses: [
            new OA\Response(
                response: ResponseAlias::HTTP_OK,
                description: 'Task created successfully',
            ),
            new OA\Response(response: ResponseAlias::HTTP_UNAUTHORIZED, description: 'Unauthorized'),
            new OA\Response(response: ResponseAlias::HTTP_NOT_FOUND, description: 'Not found'),
            new OA\Response(response: ResponseAlias::HTTP_UNPROCESSABLE_ENTITY, description: 'Unprocessable Entity'),
            new OA\Response(response: ResponseAlias::HTTP_INTERNAL_SERVER_ERROR, description: 'Server Error'),
        ]
    )]
    public function store(StoreTaskRequest $request): void
    {
        $this->taskService->store(
            data: $request->validated()
        );
    }

    #[OA\Put(
        path: '/tasks/{task}',
        summary: 'Update task',
        requestBody: new OA\RequestBody(
            required: true,
            content: new OA\JsonContent(ref: '#components/schemas/UpdateTaskRequest')
        ),
        tags: ['Task'],
        responses: [
            new OA\Response(
                response: ResponseAlias::HTTP_OK,
                description: 'Task updated successfully',
            ),
            new OA\Response(response: ResponseAlias::HTTP_UNAUTHORIZED, description: 'Unauthorized'),
            new OA\Response(response: ResponseAlias::HTTP_NOT_FOUND, description: 'Not found'),
            new OA\Response(response: ResponseAlias::HTTP_UNPROCESSABLE_ENTITY, description: 'Unprocessable Entity'),
            new OA\Response(response: ResponseAlias::HTTP_INTERNAL_SERVER_ERROR, description: 'Server Error'),
        ]
    )]
    public function update(Task $task, UpdateTaskRequest $request): void
    {
        $this->taskService->update(
            task: $task,
            data: $request->validated(),
        );
    }

    #[OA\Delete(
        path: '/tasks/{task}',
        summary: 'Delete task',
        tags: ['Task'],
        responses: [
            new OA\Response(
                response: ResponseAlias::HTTP_OK,
                description: 'Task deleted successfully',
            ),
            new OA\Response(response: ResponseAlias::HTTP_UNAUTHORIZED, description: 'Unauthorized'),
            new OA\Response(response: ResponseAlias::HTTP_NOT_FOUND, description: 'Not found'),
            new OA\Response(response: ResponseAlias::HTTP_INTERNAL_SERVER_ERROR, description: 'Server Error'),
        ]
    )]
    public function destroy(Task $task): RedirectResponse
    {
        $this->taskService->delete(
            task: $task
        );

        return to_route('tasks.index');
    }

    // #TODO: dokumentacja
    public function attachUser(Task $task, AttachUserToTaskRequest $request): void
    {
        $this->taskService->update(
            task: $task,
            data: $request->validated(),
        );
    }

    // #TODO: dokumentacja
    public function attachTaskCategory(Task $task, AttachTaskCategoryToTaskRequest $request): void
    {
        $this->taskService->update(
            task: $task,
            data: $request->validated(),
        );
    }
}
