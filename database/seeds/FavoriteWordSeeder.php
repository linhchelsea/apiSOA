<?php

use Illuminate\Database\Seeder;

class FavoriteWordSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('FavoriteWords')->insert([
            'IdUser' => 2,
            'IdVocabulary' => 2,
        ]);
        DB::table('FavoriteWords')->insert([
            'IdUser' => 2,
            'IdVocabulary' => 4,
        ]);
        DB::table('FavoriteWords')->insert([
            'IdUser' => 2,
            'IdVocabulary' => 6,
        ]);
        DB::table('FavoriteWords')->insert([
            'IdUser' => 2,
            'IdVocabulary' => 12,
        ]);
        DB::table('FavoriteWords')->insert([
            'IdUser' => 2,
            'IdVocabulary' => 22,
        ]);
        DB::table('FavoriteWords')->insert([
            'IdUser' => 2,
            'IdVocabulary' => 33,
        ]);
        DB::table('FavoriteWords')->insert([
            'IdUser' => 2,
            'IdVocabulary' => 69,
        ]);
    }
}
