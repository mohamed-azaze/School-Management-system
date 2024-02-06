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
        $this->call([
            UserSeeder::class,
            GradesSeeder::class,
            My_ClassesSeeder::class,
            SectionsSeeder::class,
            BloodTableSeeder::class,
            NationalitiesTableSeeder::class,
            ReligionTableSeeder::class,
            SpecializationSeeder::class,
            GendersSeeder::class,
            ParentsSeeder::class,
            StudentsSeeder::class,
        ]);
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}