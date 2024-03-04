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

        \App\Models\User::factory()->create([
            'name' => 'Kim Minju',
            'email' => 'minguri@izone.co.kr',
            'role' => 'admin'
        ]);

        \App\Models\User::factory()->create([
            'name' => 'Hanni Pham',
            'email' => 'hanni@nj.co.kr',
        ]);
    }
}
