<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\User;
use App\Services\UserService;
use Illuminate\Http\RedirectResponse;
use Inertia\Inertia;
use Inertia\Response;
use OpenApi\Attributes as OA;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class UserController extends Controller
{
    public function __construct(protected UserService $userService) {}

    #[OA\Get(
        path: '/users',
        summary: 'Get users list',
        tags: ['User'],
        responses: [
            new OA\Response(
                response: ResponseAlias::HTTP_OK,
                description: 'Users retrieved successfully',
                content: new OA\JsonContent(ref: '#/components/schemas/UserResource')
            ),
            new OA\Response(response: ResponseAlias::HTTP_UNAUTHORIZED, description: 'Unauthorized'),
            new OA\Response(response: ResponseAlias::HTTP_NOT_FOUND, description: 'Not found'),
            new OA\Response(response: ResponseAlias::HTTP_INTERNAL_SERVER_ERROR, description: 'Server Error'),
        ]
    )]
    public function index(): Response
    {
        return Inertia::render('User/Index', [
            'users' => $this->userService->getUsers(),
        ]);
    }

    #[OA\Get(
        path: '/users/{user}',
        summary: 'Get user',
        tags: ['User'],
        responses: [
            new OA\Response(
                response: ResponseAlias::HTTP_OK,
                description: 'User retrieved successfully',
                content: new OA\JsonContent(ref: '#/components/schemas/UserResource')
            ),
            new OA\Response(response: ResponseAlias::HTTP_UNAUTHORIZED, description: 'Unauthorized'),
            new OA\Response(response: ResponseAlias::HTTP_NOT_FOUND, description: 'Not found'),
            new OA\Response(response: ResponseAlias::HTTP_INTERNAL_SERVER_ERROR, description: 'Server Error'),
        ]
    )]
    public function show(User $user): Response
    {
        return Inertia::render('User/Show', [
            'user' => $this->userService->getOne(user: $user),
        ]);
    }

    #[OA\Post(
        path: '/users',
        summary: 'Create new user',
        requestBody: new OA\RequestBody(
            required: true,
            content: new OA\JsonContent(ref: '#components/schemas/StoreUserRequest')
        ),
        tags: ['User'],
        responses: [
            new OA\Response(
                response: ResponseAlias::HTTP_OK,
                description: 'User created successfully',
            ),
            new OA\Response(response: ResponseAlias::HTTP_UNAUTHORIZED, description: 'Unauthorized'),
            new OA\Response(response: ResponseAlias::HTTP_NOT_FOUND, description: 'Not found'),
            new OA\Response(response: ResponseAlias::HTTP_UNPROCESSABLE_ENTITY, description: 'Unprocessable Entity'),
            new OA\Response(response: ResponseAlias::HTTP_INTERNAL_SERVER_ERROR, description: 'Server Error'),
        ]
    )]
    public function store(StoreUserRequest $request): void
    {
        $this->userService->store(
            data: $request->validated()
        );
    }

    #[OA\Put(
        path: '/users/{user}',
        summary: 'Update user',
        requestBody: new OA\RequestBody(
            required: true,
            content: new OA\JsonContent(ref: '#components/schemas/UpdateUserRequest')
        ),
        tags: ['User'],
        responses: [
            new OA\Response(
                response: ResponseAlias::HTTP_OK,
                description: 'User updated successfully',
            ),
            new OA\Response(response: ResponseAlias::HTTP_UNAUTHORIZED, description: 'Unauthorized'),
            new OA\Response(response: ResponseAlias::HTTP_NOT_FOUND, description: 'Not found'),
            new OA\Response(response: ResponseAlias::HTTP_UNPROCESSABLE_ENTITY, description: 'Unprocessable Entity'),
            new OA\Response(response: ResponseAlias::HTTP_INTERNAL_SERVER_ERROR, description: 'Server Error'),
        ]
    )]
    public function update(User $user, UpdateUserRequest $request): void
    {
        $this->userService->update(
            user: $user,
            data: $request->validated(),
        );
    }

    #[OA\Delete(
        path: '/users/{user}',
        summary: 'Delete user',
        tags: ['User'],
        responses: [
            new OA\Response(
                response: ResponseAlias::HTTP_OK,
                description: 'User deleted successfully',
            ),
            new OA\Response(response: ResponseAlias::HTTP_UNAUTHORIZED, description: 'Unauthorized'),
            new OA\Response(response: ResponseAlias::HTTP_NOT_FOUND, description: 'Not found'),
            new OA\Response(response: ResponseAlias::HTTP_INTERNAL_SERVER_ERROR, description: 'Server Error'),
        ]
    )]
    public function destroy(User $user): RedirectResponse
    {
        $this->userService->delete(user: $user);

        return to_route('users.index');
    }
}
