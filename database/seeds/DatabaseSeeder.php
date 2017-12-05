<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(FavoriteWordSeeder::class);
        $this->call(LessonSeeder::class);
        $this->call(MemorizeSeeder::class);
        $this->call(SentenceSeeder::class);
        $this->call(UserLearntSeeder::class);
        $this->call(UserSeeder::class);
    }
}
