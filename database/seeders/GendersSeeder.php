<?php

namespace Database\Seeders;

use App\Models\Gender;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GendersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('genders')->delete();

        $genders = [
            ['en' => 'Male', 'ar' => 'ذكر'],
            ['en' => 'Female', 'ar' => 'انثي'],

        ];
        foreach ($genders as $ge) {
            Gender::create(['Name' => $ge]);
        }
    }
}