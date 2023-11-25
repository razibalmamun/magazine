<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class CMSSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $pages = [
            [
                'type'=>'communication',
                'content'=>'Dummy content'
            ],
            [
                'type'=>'privacy_and_policy',
                'content'=>'Dummy content'
            ],
            [
                'type'=>'terms_condition',
                'content'=>'Dummy content'
            ],
            [
                'type'=>'about_us',
                'content'=>'Dummy content'
            ],
            [
                'type'=>'advertise',
                'content'=>'Dummy content'
            ],
        ];

        \DB::table('c_m_s')->insert($pages);
    }
}
