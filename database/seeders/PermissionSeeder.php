<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = collect();
        $guard = config('auth.defaults.guard');
        $timestamp = now();

        collect(File::allFiles(app_path('Models')))->map(function ($file) {
            $modelName = preg_split('/(?=[A-Z])/', Str::camel(basename($file->getFilename(), '.php')));

            return ucwords(implode(' ', $modelName));
        })->each(function ($model) use ($permissions, $guard, $timestamp) {
            foreach (['Create', 'Edit', 'View', 'Delete', 'Restore', 'Force Delete'] as $action) {
                $permissions->push([
                    'name' => Str::lower("{$action} {$model}"),
                    'guard_name' => $guard,
                    'created_at' => $timestamp,
                    'updated_at' => $timestamp,
                ]);
            }
        });

        Permission::query()->insertOrIgnore($permissions->toArray());
    }
}
