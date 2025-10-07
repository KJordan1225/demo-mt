<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Database\Seeders\DemoTenantsSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        // Run other seeders in order
        $this->call([
            DemoTenantsSeeder::class,
            // RolesSeeder::class,
            // UsersSeeder::class,
            // CategoriesSeeder::class,
            // PostsSeeder::class,
        ]);
    }
}
