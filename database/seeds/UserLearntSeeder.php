<?php

use Illuminate\Database\Seeder;

class UserLearntSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('UserLearnt')->insert([
            'IdUser' => 2,
            'IdLesson' => 1,
            'LessonPoint' => 10
        ]);
        DB::table('UserLearnt')->insert([
            'IdUser' => 2,
            'IdLesson' => 2,
            'LessonPoint' => 10
        ]);
        DB::table('UserLearnt')->insert([
            'IdUser' => 1,
            'IdLesson' => 1,
            'LessonPoint' => 3
        ]);
        DB::table('UserLearnt')->insert([
            'IdUser' => 3,
            'IdLesson' => 1,
            'LessonPoint' => 7
        ]);
    }
}
