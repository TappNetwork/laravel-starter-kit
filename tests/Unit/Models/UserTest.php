<?php

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

uses(RefreshDatabase::class);

test('user can be created', function () {
    $user = User::factory()->create([
        'name' => 'Test User',
        'email' => 'test@example.com',
    ]);

    expect($user)->toBeInstanceOf(User::class)
        ->and($user->name)->toBe('Test User')
        ->and($user->email)->toBe('test@example.com');
});

test('user password is hashed when created', function () {
    $password = 'password123';

    $user = User::factory()->create([
        'password' => $password,
    ]);

    expect(Hash::check($password, $user->password))->toBeTrue();
});

test('user can have roles', function () {
    Role::create(['name' => 'user']);

    $user = User::factory()->create();
    $user->assignRole('user');

    expect($user->hasRole('user'))->toBeTrue()
        ->and($user->hasRole('admin'))->toBeFalse();
});

test('user can have permissions', function () {
    Permission::create(['name' => 'view user']);
    Permission::create(['name' => 'edit user']);

    $user = User::factory()->create();
    $user->givePermissionTo('view user');

    expect($user->hasPermissionTo('view user'))->toBeTrue()
        ->and($user->hasPermissionTo('edit user'))->toBeFalse();
});
