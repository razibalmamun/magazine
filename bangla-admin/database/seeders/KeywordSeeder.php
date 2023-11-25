<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class KeywordSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = [
            [
                'name' => 'test'
            ]
        ];

        \DB::table('keywords')->insert($users);
    }
}
