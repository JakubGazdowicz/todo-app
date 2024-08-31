<?php

namespace App\Http\Controllers;

use App\Http\Requests\AttachUserToTaskCategoryRequest;
use App\Http\Requests\StoreTaskCategoryRequest;
use App\Http\Requests\UpdateTaskCategoryRequest;
use App\Models\TaskCategory;
use App\Services\TaskCategoryService;
use Illuminate\Http\RedirectResponse;
use Inertia\Inertia;
use Inertia\Response;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;
use OpenApi\Attributes as OA;

class TaskCategoryController extends Controller
{
    public function __construct(protected TaskCategoryService $taskCategoryService) {}

    #[OA\Get(
        path: '/task-categories',
        summary: 'Get task categories list',
        tags: ['Task Category'],
        responses: [
            new OA\Response(
                response: ResponseAlias::HTTP_OK,
                description: 'Task categories retrieved successfully',
                content: new OA\JsonContent(ref: '#/components/schemas/TaskCategoryResource')
            ),
            new OA\Response(response: ResponseAlias::HTTP_UNAUTHORIZED, description: 'Unauthorized'),
            new OA\Response(response: ResponseAlias::HTTP_NOT_FOUND, description: 'Not found'),
            new OA\Response(response: ResponseAlias::HTTP_INTERNAL_SERVER_ERROR, description: 'Server Error'),
        ]
    )]
    public function index(): Response
    {
        return Inertia::render('TaskCategory/Index', [
            'taskCategories' => $this->taskCategoryService->getTaskCategories(),
        ]);
    }

    #[OA\Get(
        path: '/task-categories/{taskCategory}',
        summary: 'Get task category',
        tags: ['Task Category'],
        responses: [
            new OA\Response(
                response: ResponseAlias::HTTP_OK,
                description: 'Task category retrieved successfully',
                content: new OA\JsonContent(ref: '#/components/schemas/TaskCategoryResource')
            ),
            new OA\Response(response: ResponseAlias::HTTP_UNAUTHORIZED, description: 'Unauthorized'),
            new OA\Response(response: ResponseAlias::HTTP_NOT_FOUND, description: 'Not found'),
            new OA\Response(response: ResponseAlias::HTTP_INTERNAL_SERVER_ERROR, description: 'Server Error'),
        ]
    )]
    public function show(TaskCategory $taskCategory): Response
    {
        return Inertia::render('TaskCategory/Show', [
            'taskCategory' => $this->taskCategoryService->getOne(taskCategory: $taskCategory),
        ]);
    }

    #[OA\Post(
        path: '/task-categories',
        summary: 'Create new task category',
        requestBody: new OA\RequestBody(
            required: true,
            content: new OA\JsonContent(ref: '#components/schemas/StoreTaskCategoryRequest')
        ),
        tags: ['Task Category'],
        responses: [
            new OA\Response(
                response: ResponseAlias::HTTP_OK,
                description: 'Task category created successfully',
            ),
            new OA\Response(response: ResponseAlias::HTTP_UNAUTHORIZED, description: 'Unauthorized'),
            new OA\Response(response: ResponseAlias::HTTP_NOT_FOUND, description: 'Not found'),
            new OA\Response(response: ResponseAlias::HTTP_UNPROCESSABLE_ENTITY, description: 'Unprocessable Entity'),
            new OA\Response(response: ResponseAlias::HTTP_INTERNAL_SERVER_ERROR, description: 'Server Error'),
        ]
    )]
    public function store(StoreTaskCategoryRequest $request): void
    {
        $this->taskCategoryService->store(
            data: $request->validated()
        );
    }

    #[OA\Put(
        path: '/task-categories/{taskCategory}',
        summary: 'Update task category',
        requestBody: new OA\RequestBody(
            required: true,
            content: new OA\JsonContent(ref: '#components/schemas/UpdateTaskCategoryRequest')
        ),
        tags: ['Task Category'],
        responses: [
            new OA\Response(
                response: ResponseAlias::HTTP_OK,
                description: 'Task category updated successfully',
            ),
            new OA\Response(response: ResponseAlias::HTTP_UNAUTHORIZED, description: 'Unauthorized'),
            new OA\Response(response: ResponseAlias::HTTP_NOT_FOUND, description: 'Not found'),
            new OA\Response(response: ResponseAlias::HTTP_UNPROCESSABLE_ENTITY, description: 'Unprocessable Entity'),
            new OA\Response(response: ResponseAlias::HTTP_INTERNAL_SERVER_ERROR, description: 'Server Error'),
        ]
    )]
    public function update(TaskCategory $taskCategory, UpdateTaskCategoryRequest $request): void
    {
        $this->taskCategoryService->update(
            taskCategory: $taskCategory,
            data: $request->validated(),
        );
    }

    #[OA\Delete(
        path: '/task-categories/{taskCategory}',
        summary: 'Delete task category',
        tags: ['Task Category'],
        responses: [
            new OA\Response(
                response: ResponseAlias::HTTP_OK,
                description: 'Task category deleted successfully',
            ),
            new OA\Response(response: ResponseAlias::HTTP_UNAUTHORIZED, description: 'Unauthorized'),
            new OA\Response(response: ResponseAlias::HTTP_NOT_FOUND, description: 'Not found'),
            new OA\Response(response: ResponseAlias::HTTP_INTERNAL_SERVER_ERROR, description: 'Server Error'),
        ]
    )]
    public function destroy(TaskCategory $taskCategory): RedirectResponse
    {
        $this->taskCategoryService->delete(taskCategory: $taskCategory);

        return to_route('task-categories.index');
    }

    #TODO: Dokumentacja
    public function attachUser(TaskCategory $taskCategory, AttachUserToTaskCategoryRequest $request): void
    {
        $this->taskCategoryService->attachUser(
            taskCategory: $taskCategory,
            data: $request->validated(),
        );
    }
}
