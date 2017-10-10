<?php

use Illuminate\Database\Seeder;

class SentenceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('Sentence')->insert([
            'EngSentence' => 'What\'s up ?',
            'VieSentence' => 'Có chuyện gì vậy?'
        ]);
        DB::table('Sentence')->insert([
            'EngSentence' => 'How\'s it going ?',
            'VieSentence' => 'Dạo này ra sao rồi?'
        ]);
        DB::table('Sentence')->insert([
            'EngSentence' => 'What have you been doing?',
            'VieSentence' => 'Dạo này đang làm gì?'
        ]);
        DB::table('Sentence')->insert([
            'EngSentence' => 'Nothing much',
            'VieSentence' => 'Không có gì mới cả'
        ]);
        DB::table('Sentence')->insert([
            'EngSentence' => 'What is your name?',
            'VieSentence' => 'Bạn tên là gì?'
        ]);
    }
}
