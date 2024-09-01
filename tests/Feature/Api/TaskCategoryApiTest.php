<?php

use App\Models\TaskCategory;
use App\Models\User;
use Carbon\Carbon;

beforeEach(function () {
    $this->user = User::factory()->create();
    $this->taskCategory = TaskCategory::factory()->create([
        'user_id' => $this->user->id,
    ]);
});

describe('TaskCategoryApiTest', function () {
   describe('index', function () {
       it('should return an Inertia page with a list of task categories', function () {
           $response = $this
               ->actingAs($this->user)
               ->getJson(route('task-categories.index'))
               ->assertInertia(fn($page) => $page->component('TaskCategory/Index')
                   ->has('taskCategories')
               );

           $response->when($response->status() === 200, function ($response) {
               expect(count($response['page']['props']['taskCategories']))
                   ->toBeGreaterThanOrEqual(1);
           });
       });
   });

    describe('show', function () {
        it('should return an Inertia page with a task category', function () {
            $response = $this
                ->actingAs($this->user)
                ->getJson(route('task-categories.show', $this->taskCategory))
                ->assertInertia(fn($page) => $page->component('TaskCategory/Show')
                    ->has('taskCategory')
                );

            $response
                ->when($response->status() === 200, function ($response) {
                    $data = $response['page']['props']['taskCategory'];

                    expect($data)->toBeArray()->toHaveKeys([
                        'id', 'name', 'userId', 'createdAt', 'updatedAt'
                    ])
                        ->and($data['id'])->toBe($this->taskCategory->id)
                        ->and($data['name'])->toBe($this->taskCategory->name)
                        ->and($data['userId'])->toBe($this->taskCategory->user_id)
                        ->and($data['createdAt'])->toBe(Carbon::dateFormat($this->taskCategory->created_at))
                        ->and($data['updatedAt'])->toBe(Carbon::dateFormat($this->taskCategory->updated_at));
                });
        });
    });

    describe('store', function () {
        it('should create task category with valid data', function () {
            $taskCategoryData = [
                'name' => fake()->firstName,
                'user_id' => $this->user->id,
            ];

            $response = $this
                ->actingAs($this->user)
                ->postJson(route('task-categories.store'), $taskCategoryData)
                ->assertOk();

            $response->when($response->status() === 200, function () use ($taskCategoryData) {
                $this->assertDatabaseHas('task_categories', [
                    'name' => $taskCategoryData['name'],
                    'user_id' => $taskCategoryData['user_id'],
                ]);
            });
        });

        it('should not create task category with invalid data', function () {
            $taskCategoryData = [];

            $response = $this
                ->actingAs($this->user)
                ->postJson(route('task-categories.store'), $taskCategoryData)
                ->assertUnprocessable();

            $response->when($response->status() === 422, function($response) {
                $data = $response['errors'];

                expect($data)
                    ->toBeArray()
                    ->toHaveKeys(['name'])
                    ->and($data['name'])->toBe(['Pole nazwa kategorii jest wymagane']);
            });
        });
    });

    describe('update', function () {
        it('should update task category with valid data', function () {
            $anotherUser = User::factory()->create();

            $taskCategoryData = [
                'name' => fake()->name,
                'user_id' => $anotherUser->id,
            ];

            $response = $this
                ->actingAs($this->user)
                ->putJson(route('task-categories.update', $this->taskCategory), $taskCategoryData)
                ->assertOk();

            $response->when($response->status() === 200, function () use ($taskCategoryData) {
                $this->assertDatabaseHas('task_categories', [
                    'name' => $taskCategoryData['name'],
                    'user_id' => $taskCategoryData['user_id'],
                ]);
            });
        });

        it('should not update task category with invalid data', function () {
            $taskCategoryData = [];

            $response = $this
                ->actingAs($this->user)
                ->putJson(route('task-categories.update', $this->taskCategory), $taskCategoryData)
                ->assertUnprocessable();

            $response->when($response->status() === 422, function($response) {
                $data = $response['errors'];

                expect($data)
                    ->toBeArray()
                    ->toHaveKeys(['name'])
                    ->and($data['name'])->toBe(['Pole nazwa kategorii jest wymagane']);
            });
        });
    });

    describe('destroy', function () {
        it('should delete task category', function () {
            $response = $this
                ->actingAs($this->user)
                ->deleteJson(route('task-categories.destroy', $this->taskCategory))
                ->assertRedirect(route('task-categories.index'));

            $response->when($response->status() === 302, function () {
                $this->assertDatabaseMissing('task_categories', [
                    'id' => $this->taskCategory->id,
                    'name' => $this->taskCategory->name,
                    'user_id' => $this->taskCategory->user_id,
                ]);
            });
        });
    });

    describe('attachUser', function () {
       it('should attach user to the task category', function () {
           $task = TaskCategory::factory()->create([
               'user_id' => null
           ]);

           $attachData = [
               'user_id' => $this->user->id,
           ];

           $response = $this
               ->actingAs($this->user)
               ->postJson(route('task-categories.attach-user', $task), $attachData)
               ->assertOk();

           $response->when($response->status() === 200, function () use ($attachData, $task) {
               $this->assertDatabaseHas('task_categories', [
                   'name' => $task->name,
                   'user_id' => $attachData['user_id'],
               ]);
           });
       });
    });
});
