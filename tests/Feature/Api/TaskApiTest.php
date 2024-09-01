<?php

use App\Models\Task;
use App\Models\TaskCategory;
use App\Models\User;
use Carbon\Carbon;

beforeEach(function() {
    $this->user = User::factory()->create();
    $this->task = Task::factory()->create([
        'user_id' => $this->user->id,
    ]);
});

describe('TaskApiTest', function () {
    describe('index', function () {
        it('should return an Inertia page with a list of tasks', function () {
            $response = $this
                ->actingAs($this->user)
                ->getJson(route('tasks.index'))
                ->assertInertia(fn($page) => $page->component('Task/Index')
                    ->has('tasks')
                );

            $response->when($response->status() === 200, function ($response) {
                expect(count($response['page']['props']['tasks']))
                    ->toBeGreaterThanOrEqual(1);
            });
        });
    });

    describe('show', function () {
        it('should return an Inertia page with a task', function () {
            $response = $this
                ->actingAs($this->user)
                ->getJson(route('tasks.show', $this->task))
                ->assertInertia(fn($page) => $page->component('Task/Show')
                    ->has('task')
                );

            $response
                ->when($response->status() === 200, function ($response) {
                    $data = $response['page']['props']['task'];

                    expect($data)->toBeArray()->toHaveKeys([
                        'id', 'name', 'durationMinutes', 'description', 'userId', 'taskCategoryId', 'createdAt', 'updatedAt'
                    ])
                        ->and($data['id'])->toBe($this->task->id)
                        ->and($data['name'])->toBe($this->task->name)
                        ->and($data['durationMinutes'])->toBe($this->task->duration_minutes)
                        ->and($data['description'])->toBe($this->task->description)
                        ->and($data['userId'])->toBe($this->task->user_id)
                        ->and($data['taskCategoryId'])->toBe($this->task->task_category_id)
                        ->and($data['createdAt'])->toBe(Carbon::dateFormat($this->task->created_at))
                        ->and($data['updatedAt'])->toBe(Carbon::dateFormat($this->task->updated_at));
                });
        });
    });

    describe('store', function () {
        it('should create task with valid data', function () {
            $taskData = [
                'name' => fake()->word,
                'description' => fake()->sentence(5),
                'duration_minutes' => fake()->numberBetween(60, 480)
            ];

            $response = $this
                ->actingAs($this->user)
                ->postJson(route('tasks.store'), $taskData)
                ->assertOk();

            $response->when($response->status() === 200, function () use ($taskData) {
                $this->assertDatabaseHas('tasks', [
                    'name' => $taskData['name'],
                    'description' => $taskData['description'],
                ]);
            });
        });

        it('should not create task with invalid data', function () {
            $taskData = [];

            $response = $this
                ->actingAs($this->user)
                ->postJson(route('tasks.store'), $taskData)
                ->assertUnprocessable();

            $response->when($response->status() === 422, function($response) {
                $data = $response['errors'];

                expect($data)
                    ->toBeArray()
                    ->toHaveKeys(['name', 'duration_minutes'])
                    ->and($data['name'])->toBe(['Pole nazwa jest wymagane'])
                    ->and($data['duration_minutes'])->toBe(['Pole przewidywany czas jest wymagane']);
            });
        });
    });

    describe('update', function () {
        it('should update task with valid data', function () {
            $anotherUser = User::factory()->create();

            $taskData = [
                'name' => fake()->name,
                'user_id' => $anotherUser->id,
                'duration_minutes' => fake()->numberBetween(60, 480)
            ];

            $response = $this
                ->actingAs($this->user)
                ->putJson(route('tasks.update', $this->task), $taskData)
                ->assertOk();

            $response->when($response->status() === 200, function () use ($taskData) {
                $this->assertDatabaseHas('tasks', [
                    'name' => $taskData['name'],
                    'user_id' => $taskData['user_id'],
                ]);
            });
        });

        it('should not update task with invalid data', function () {
            $taskData = [];

            $response = $this
                ->actingAs($this->user)
                ->putJson(route('tasks.update', $this->task), $taskData)
                ->assertUnprocessable();

            $response->when($response->status() === 422, function($response) {
                $data = $response['errors'];

                expect($data)
                    ->toBeArray()
                    ->toHaveKeys(['name'])
                    ->and($data['name'])->toBe(['Pole nazwa jest wymagane']);
            });
        });
    });

    describe('destroy', function () {
        it('should delete task', function () {
            $response = $this
                ->actingAs($this->user)
                ->deleteJson(route('tasks.destroy', $this->task))
                ->assertRedirect(route('tasks.index'));

            $response->when($response->status() === 302, function () {
                $this->assertDatabaseMissing('tasks', [
                    'id' => $this->task->id,
                    'name' => $this->task->name,
                    'user_id' => $this->task->user_id,
                ]);
            });
        });
    });

    describe('attachUser', function () {
        it('should attach user to the task', function () {
            $task = Task::factory()->create([
                'user_id' => null
            ]);

            $attachData = [
                'user_id' => $this->user->id,
            ];

            $response = $this
                ->actingAs($this->user)
                ->postJson(route('tasks.attach-user', $task), $attachData)
                ->assertOk();

            $response->when($response->status() === 200, function () use ($attachData, $task) {
                $this->assertDatabaseHas('tasks', [
                    'name' => $task->name,
                    'user_id' => $attachData['user_id'],
                ]);
            });
        });
    });

    describe('attachTaskCategory', function () {
        it('should attach task category to the task', function () {
            $task = Task::factory()->create([
                'user_id' => null
            ]);

            $taskCategory = TaskCategory::factory()->create();

            $attachData = [
                'task_category_id' => $taskCategory->id,
            ];

            $response = $this
                ->actingAs($this->user)
                ->postJson(route('tasks.attach-task-category', $task), $attachData)
                ->assertOk();

            $response->when($response->status() === 200, function () use ($attachData, $task) {
                $this->assertDatabaseHas('tasks', [
                    'name' => $task->name,
                    'task_category_id' => $attachData['task_category_id'],
                ]);
            });
        });
    });
});
