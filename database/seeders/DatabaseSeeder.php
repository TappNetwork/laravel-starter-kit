<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        if (! app()->isProduction()) {
            $this->call(PermissionSeeder::class);
            $this->call(RoleSeeder::class);
            $this->call(UserSeeder::class);
        }
    }
}
