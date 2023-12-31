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
        // \App\Models\User::factory(10)->create();

        \App\Models\User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);
        \App\Models\User::factory()->create([
            'name' => 'Pawel Kawa',
            'email' => 'ramzord@gmail.com',
            'is_admin' => true
        ]);
            \App\Models\Listing::factory(20)->create(
                [
                    'by_user_id' => 1
                ]
            );
            \App\Models\Listing::factory(20)->create(
                [
                    'by_user_id' => 2
                ]
            );
    }
}
