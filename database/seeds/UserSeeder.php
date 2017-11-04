<?php

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('Users')->insert([
            'Username' => 'linhchelsea',
            'Password' => '$2y$10$hW6ajkxn6YfXLlJj8Ea6FOcCDMn6L3C2vJiy3YvjcqMdm874nzLnu',
            'Fullname' => 'Nguyen Manh Linh',
            'Email' => 'linhchelsea@gmail.com',
            'Level' => 1,
            'TotalPoint' => 3,
        ]);
        DB::table('Users')->insert([
            'Username' => 'linhbarca',
            'Password' => '$2y$10$8ZQSLthyyHmlTeJ9nxSwSOHsHrBjpBxL6MWPcvaTFqnjTRKfy01r6',
            'Fullname' => 'Nguyen Dang Duc Linh',
            'Email' => 'linhngok@gmail.com',
            'Level' => 1,
            'TotalPoint' => 20,
        ]);
        DB::table('Users')->insert([
            'Username' => 'linhliver',
            'Password' => '$2y$10$8ZQSLthyyHmlTeJ9nxSwSOHsHrBjpBxL6MWPcvaTFqnjTRKfy01r6',
            'Fullname' => 'Nguyen Van Liver',
            'Email' => 'linhliver@gmail.com',
            'Level' => 1,
            'TotalPoint' => 7,
        ]);
    }
}
