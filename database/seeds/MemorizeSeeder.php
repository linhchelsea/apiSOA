<?php

use Illuminate\Database\Seeder;

class MemorizeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('Memorize')->insert([
            'IdUser' => 2,
            'IdVocabulary' => 69,
            'Content' => 'Bạn tên là gì?'
        ]);
        DB::table('Memorize')->insert([
            'IdUser' => 2,
            'IdVocabulary' => 70,
            'Content' => 'Tìm vật gì đó'
        ]);
        DB::table('Memorize')->insert([
            'IdUser' => 2,
            'IdVocabulary' => 70,
            'Content' => 'search khác f'
        ]);
        DB::table('Memorize')->insert([
            'IdUser' => 2,
            'IdVocabulary' => 1,
            'Content' => 'Tuân theo cái gì đó, ví dụ luật'
        ]);
    }
}
