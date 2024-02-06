<?php

namespace Database\Seeders;

use App\Models\Grade;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GradesSeeder extends Seeder
{

    public function run(): void
    {
        DB::table('Grades')->delete();

        $grades = [
            ['en' => 'Grade One', 'ar' => 'المرحلة الابتدائية'],
            ['en' => 'middle School', 'ar' => 'المرحلةالاعدادية'],
            ['en' => 'High School', 'ar' => 'المرحلة الثانوية'],
        ];

        foreach ($grades as $gr) {
            Grade::create(['Name' => $gr]);
        }
    }
}
