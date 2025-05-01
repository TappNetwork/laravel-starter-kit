<?php

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Route;

uses(RefreshDatabase::class);

beforeEach(function () {
    $this->seed();
});

// Helper functions to get routes
function getGuestRoutes()
{
    $rejectRoutes = [
        'pulse',
        'auth/google',
        'user/confirm-password',
        'user/confirmed-password-status',
        'two-factor-challenge',
        'user/two-factor-qr-code',
        'user/two-factor-secret-key',
        'user/two-factor-recovery-codes',
        'livewire/livewire.min.js',
    ];

    $rejectFrontendRoutes = [
        '/',
    ];

    $frontendRoutes = [
    ];

    return collect(Route::getRoutes())
        ->filter(fn ($route) => in_array('GET', $route->methods()))
        ->reject(fn ($route) => in_array('auth', $route->gatherMiddleware()))
        ->reject(fn ($route) => in_array($route->uri(), ['sanctum/csrf-cookie', '_ignition/health-check', 'api/user']))
        ->reject(fn ($route) => str_contains($route->uri(), 'admin'))
        ->reject(fn ($route) => in_array($route->uri(), $frontendRoutes))
        ->reject(fn ($route) => in_array($route->uri(), $rejectRoutes))
        ->reject(fn ($route) => in_array($route->uri(), $rejectFrontendRoutes))
        ->reject(fn ($route) => str_contains($route->uri(), '{'))
        ->reject(fn ($route) => str_contains($route->uri(), 'debug'))
        ->map(fn ($route) => $route->uri())
        ->values()
        ->toArray();
}

function getFrontendRoutes()
{
    $frontendRoutes = [
    ];

    $rejectFrontendRoutes = [
        '/',
    ];

    return collect(Route::getRoutes())
        ->filter(fn ($route) => in_array('GET', $route->methods()))
        ->reject(fn ($route) => in_array($route->uri(), ['sanctum/csrf-cookie', '_ignition/health-check', 'api/user']))
        ->reject(fn ($route) => str_contains($route->uri(), 'admin'))
        ->filter(fn ($route) => in_array($route->uri(), $frontendRoutes))
        ->reject(fn ($route) => in_array($route->uri(), $rejectFrontendRoutes))
        ->reject(fn ($route) => str_contains($route->uri(), '{'))
        ->reject(fn ($route) => str_contains($route->uri(), 'create'))
        ->reject(fn ($route) => str_contains($route->uri(), 'debug'))
        ->map(fn ($route) => $route->uri())
        ->values()
        ->toArray();
}

it('can render all guest routes', function () {
    $routes = getGuestRoutes();

    foreach ($routes as $url) {
        $this->get($url)->assertOk();
    }
});

it('can render all frontend routes', function () {
    $this->actingAs(User::where('email', 'admin@dev.com')->first());

    $routes = getFrontendRoutes();

    foreach ($routes as $url) {
        $this->get($url)->assertOk();
    }
});
