<?php
namespace Database\Seeders;

use App\Models\Classroom;
use App\Models\Grade;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class My_ClassesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('classrooms')->delete();

        $classrooms = [
            ['en' => 'class One', 'ar' => 'الصف الاول'],
            ['en' => 'class Two', 'ar' => 'الصف الثانى'],
            ['en' => 'class There', 'ar' => 'الصف الثالث'],

        ];

        foreach ($classrooms as $classroom) {
            Classroom::create([
                'class_name' => $classroom,
                'grade_id'   => Grade::all()->unique()->random()->id,
            ]);
        }

    }
}