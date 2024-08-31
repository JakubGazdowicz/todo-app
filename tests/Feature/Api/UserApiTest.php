<?php

use App\Models\User;
use Carbon\Carbon;

beforeEach(function () {
    $this->user = User::factory()->create();
});

describe('UserApiTest', function () {
   describe('index', function () {
       it('should return an Inertia page with a list of users', function () {
            $response = $this
                ->actingAs($this->user)
                ->getJson(route('users.index'))
                ->assertInertia(fn($page) => $page->component('User/Index')
                    ->has('users')
                );

            $response->when($response->status() === 200, function ($response) {
                expect(count($response['page']['props']['users']))
                    ->toBeGreaterThanOrEqual(1);
            });
       });
   });

   describe('show', function () {
      it('should return an Inertia page with a user', function () {
          $response = $this
              ->actingAs($this->user)
              ->getJson(route('users.show', $this->user))
              ->assertInertia(fn($page) => $page->component('User/Show')
                  ->has('user')
              );

          $response
              ->when($response->status() === 200, function ($response) {
                  $data = $response['page']['props']['user'];

                  expect($data)->toBeArray()->toHaveKeys([
                      'id', 'name', 'email', 'createdAt', 'updatedAt'
                  ])
                      ->and($data['id'])->toBe($this->user->id)
                      ->and($data['name'])->toBe($this->user->name)
                      ->and($data['email'])->toBe($this->user->email)
                      ->and($data['createdAt'])->toBe(Carbon::dateFormat($this->user->created_at))
                      ->and($data['updatedAt'])->toBe(Carbon::dateFormat($this->user->updated_at));
              });
      });
   });

   describe('store', function () {
        it('should create user with valid data', function () {
            $userData = [
                'name' => fake()->firstName,
                'email' => fake()->unique()->email,
                'password' => 'password'
            ];

            $response = $this
                ->actingAs($this->user)
                ->postJson(route('users.store'), $userData)
                ->assertOk();

            $response->when($response->status() === 200, function () use ($userData) {
                $this->assertDatabaseHas('users', [
                    'name' => $userData['name'],
                    'email' => $userData['email'],
                ]);
            });
        });

        it('should not create user with invalid data', function () {
            $userData = [];

            $response = $this
                ->actingAs($this->user)
                ->postJson(route('users.store'), $userData)
                ->assertUnprocessable();

            $response->when($response->status() === 422, function($response) {
                $data = $response['errors'];

                expect($data)
                    ->toBeArray()
                    ->toHaveKeys(['name', 'email', 'password'])
                    ->and($data['name'])->toBe(['Pole nazwa użytkownika jest wymagane'])
                    ->and($data['email'])->toBe(['Pole email jest wymagane'])
                    ->and($data['password'])->toBe(['Pole hasło jest wymagane']);
            });
        });
   });

   describe('update', function () {
       it('should update user with valid data', function () {
           $userData = [
               'name' => fake()->name,
               'email' => fake()->unique()->email,
               'password' => 'password'
           ];

           $response = $this
               ->actingAs($this->user)
               ->putJson(route('users.update', $this->user), $userData)
               ->assertOk();

           $response->when($response->status() === 200, function () use ($userData) {
               $this->assertDatabaseHas('users', [
                   'name' => $userData['name'],
                   'email' => $userData['email'],
               ]);
           });
       });

       it('should not update user with invalid data', function () {
           $userData = [];

           $response = $this
               ->actingAs($this->user)
               ->putJson(route('users.update', $this->user), $userData)
               ->assertUnprocessable();

           $response->when($response->status() === 422, function($response) {
               $data = $response['errors'];

               expect($data)
                   ->toBeArray()
                   ->toHaveKeys(['name', 'email'])
                   ->and($data['name'])->toBe(['Pole nazwa użytkownika jest wymagane'])
                   ->and($data['email'])->toBe(['Pole email jest wymagane']);
           });
       });
   });

   describe('destroy', function () {
       it('should delete user', function () {
           $userToDelete = User::factory()->create();

           $response = $this
               ->actingAs($this->user)
               ->deleteJson(route('users.destroy', $userToDelete))
               ->assertRedirect(route('users.index'));

           $response->when($response->status() === 302, function () use ($userToDelete) {
               $this->assertDatabaseMissing('users', [
                   'id' => $userToDelete->id,
                   'name' => $userToDelete->name,
                   'email' => $userToDelete->email,
               ]);
           });
       });
   });
});

